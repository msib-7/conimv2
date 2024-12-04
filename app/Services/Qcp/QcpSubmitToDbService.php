<?php

namespace App\Services\Qcp;

use App\Events\NotificationEvent;
use App\Models\System\HistoryQualityCircleProject;
use App\Models\System\QualityCircleProject;
use App\Models\System\TeamsQualityCircleProject;
use App\Services\System\ApprovalMailService;
use App\Services\System\GetFasilitatorService;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class QcpSubmitToDbService.
 */
class QcpSubmitToDbService
{
    public function handle($request)
    {
        $request->validate([
            'tema' => 'required',
            'teams' => 'required',
            'cost_saving' => 'required|numeric',
            'lampiran' => 'required|file|mimes:pdf|max:3072', // Maksimum 3 MB
            'sebelum' => 'required',
            'sesudah' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $qcp = QualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'teams' => $request->teams,
                'sebelum' => $request->sebelum,
                'sesudah' => $request->sesudah,
                'cost_saving' => $request->cost_saving,
                'status' => 'publish',
                'lampiran' => (new UploadToMinioService)->handle($request->lampiran, 'qcp'),
                'approval' => 101,
            ]);

            HistoryQualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'quality_circle_project_id' => $qcp->id,
                'status' => 101
            ]);

            foreach ($request->anggota as $anggota) {
                # code...
                $result_anggota = explode(' - ', $anggota);
                // dd($result_anggota);
                TeamsQualityCircleProject::create([
                    'user_id' => auth()->user()->id,
                    'quality_circle_project_id' => $qcp->id,
                    'member' => $result_anggota[0],
                    'fullname' => $result_anggota[1],
                ]);
            }

            event(new NotificationEvent(
                auth()->user()->id,
                'Added Quality Circle Project',
                'Terima Kasih Telah Membuat Quality Circle Project',
                route('v1.qcp.index')
            ));

            $fasilitator = (new GetFasilitatorService)->hrisGetEmployee(auth()->user()->result['SuperiorNIK']);
            $message = 'Halo anda baru saja menerima permintaan persetujuan Quality Control Project yang telah dibuat oleh ' . auth()->user()->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Approval Fasilitator',
                'link' => route('v1.approval.fasilitator.qcp.index'),
                'penerima' => $fasilitator[0]['fullname'],
                'body' => $message
            ];

            (new ApprovalMailService)->handle($fasilitator[0]['email'], $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Submit',
                'redirect' => route('v1.qcp.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error creating QCP : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
