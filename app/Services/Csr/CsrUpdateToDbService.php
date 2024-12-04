<?php

namespace App\Services\Csr;

use App\Events\NotificationEvent;
use App\Models\System\HistoryCostSavingReport;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;

/**
 * Class CsrUpdateToDbService.
 */
class CsrUpdateToDbService
{

    public function handle($request, $data)
    {
        try {
            DB::beginTransaction();

            if (!in_array($data->statusApproval->code, [102, 202, 302, 402, 100])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak Dalam Revisi'
                ]);
            }

            $request->validate([
                'tema' => 'required',
                'cost_saving' => 'required|numeric',
                'lampiran' => 'file|mimes:pdf|max:3072', // Maksimum 3 MB
                'sebelum' => 'required',
                'sesudah' => 'required'
            ]);

            $data->update([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'sebelum' => $request->sebelum,
                'sesudah' => $request->sesudah,
                'cost_saving' => $request->cost_saving,
                'status' => 'publish',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'csr') : null,
                'approval' => 101
            ]);

            HistoryCostSavingReport::create([
                'user_id' => auth()->user()->id,
                'cost_saving_report_id' => $data->id,
                'status' => 101
            ]);

            event(new NotificationEvent(
                auth()->user()->id,
                'Revisi Cost Saving Report',
                'Terima Kasih Update Revisi Cost Saving Report Anda',
                route('v1.csr.index')
            ));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Telah Melakukan Revisi',
                'redirect' => route('v1.csr.index')
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
