<?php

namespace App\Services\Qcp;

use App\Events\NotificationEvent;
use App\Models\System\HistoryQualityCircleProject;
use App\Models\System\TeamsQualityCircleProject;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class QcpUpdateToDbService.
 */
class QcpUpdateToDbService
{
    public function handle($data, $request)
    {
        try {
            DB::beginTransaction();

            $data->update([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'sebelum' => $request->sebelum ?? null,
                'sesudah' => $request->sesudah ?? null,
                'cost_saving' => $request->cost_saving ?? null,
                'status' => 'publish',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'qcp') : $data->lampiran,
                'approval' => 101
            ]);

            HistoryQualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'quality_circle_project_id' => $data->id,
                'status' => 101
            ]);

            if ($request->anggota) {
                # code...
                TeamsQualityCircleProject::where('quality_circle_project_id', $data->id)->delete();

                foreach ($request->anggota as $anggota) {
                    # code...
                    $result_anggota = explode(' - ', $anggota);
                    // dd($result_anggota);
                    TeamsQualityCircleProject::create([
                        'user_id' => auth()->user()->id,
                        'quality_circle_project_id' => $data->id,
                        'member' => $result_anggota[0],
                        'fullname' => $result_anggota[1],
                    ]);
                }
            }

            event(new NotificationEvent(
                auth()->user()->id,
                'Added Quality Circle Project',
                'Terima Kasih Telah Membuat Quality Circle Project',
                route('v1.qcp.index')
            ));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Telah Melakukan Revisi',
                'redirect' => route('v1.qcp.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error creating QCP Update : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
