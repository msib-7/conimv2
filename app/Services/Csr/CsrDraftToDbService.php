<?php

namespace App\Services\Csr;

use App\Models\System\CostSavingReport;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CsrDraftToDbService.
 */
class CsrDraftToDbService
{
    public function handle($request)
    {
        try {
            DB::beginTransaction();

            CostSavingReport::create([
                'user_id' => auth()->user()->id,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema ?? null,
                'sebelum' => $request->sebelum ?? null,
                'sesudah' => $request->sesudah ?? null,
                'cost_saving' => $request->cost_saving ?? null,
                'status' => 'draft',
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'csr') : null,
                'approval' => 100,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Draft Data',
                'redirect' => route('v1.csr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error Draft CSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
