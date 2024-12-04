<?php

namespace App\Services\Csr;

use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CsrUpdateDraftToDbService.
 */
class CsrUpdateDraftToDbService
{
    public function handle($request, $data)
    {
        try {
            DB::beginTransaction();
            $data->update([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'sebelum' => $request->sebelum,
                'sesudah' => $request->sesudah,
                'cost_saving' => $request->cost_saving,
                'status' => 'draft',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'csr') : null,
                'approval' => 100
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Update Draft Success',
                'redirect' => route('v1.csr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error Update Draft CSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
