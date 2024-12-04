<?php

namespace App\Services\Csr;

use App\Events\NotificationEvent;
use App\Models\System\CostSavingReport;
use App\Models\System\HistoryCostSavingReport;
use App\Services\System\ApprovalMailService;
use App\Services\System\GetFasilitatorService;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CsrSubmitToDbService.
 */
class CsrSubmitToDbService
{
    public function handle($request)
    {
        try {
            DB::beginTransaction();

            $csr = CostSavingReport::create([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'sebelum' => $request->sebelum,
                'sesudah' => $request->sesudah,
                'cost_saving' => $request->cost_saving,
                'status' => 'publish',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'csr') : null,
                'approval' => 101,
            ]);

            HistoryCostSavingReport::create([
                'user_id' => auth()->user()->id,
                'cost_saving_report_id' => $csr->id,
                'status' => 101
            ]);

            event(new NotificationEvent(
                auth()->user()->id,
                'Added Cost Saving Report',
                'Terima Kasih Telah Membuat Cost Saving Report',
                route('v1.csr.index')
            ));

            $message = 'Halo anda baru saja menerima permintaan persetujuan Cost Saving Report yang telah dibuat oleh ' . auth()->user()->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Approval Fasilitator',
                'link' => route('v1.approval.fasilitator.csr.index'),
                'penerima' => auth()->user()->result['SuperiorName'],
                'body' => $message
            ];
            $emailFasilitator = (new GetFasilitatorService)->hrisGetEmployee(auth()->user()->result['SuperiorNIK']);
            $emailFasilitator = $emailFasilitator[0]['email'];

            (new ApprovalMailService)->handle($emailFasilitator, $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Submit',
                'redirect' => route('v1.csr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error added CSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
