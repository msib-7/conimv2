<?php

namespace App\Services\Qcp;

use App\Events\NotificationEvent;
use App\Models\System\HistoryQualityCircleProject;
use App\Models\System\QualityCircleProject;
use App\Models\System\TeamsQualityCircleProject;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class QcpSubmitDraftToDbService.
 */
class QcpSubmitDraftToDbService
{
    public function handle($request)
    {
        try {
            DB::beginTransaction();

            $data = QualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'teams' => $request->teams,
                'sebelum' => $request->sebelum ?? null,
                'sesudah' => $request->sesudah ?? null,
                'cost_saving' => $request->cost_saving ?? null,
                'status' => 'draft',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'qcp') : null,
                'approval' => 100,
            ]);

            if ($request->anggota) {
                # code...
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

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Saved Draft',
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
