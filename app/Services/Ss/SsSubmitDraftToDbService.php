<?php

namespace App\Services\Ss;

use App\Models\System\SuggestionSystem;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SsSubmitDraftToDbService.
 */
class SsSubmitDraftToDbService
{
    public function handle($request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'mesin' => 'required|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $ss = SuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'mesin_id' => $request->mesin,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'lokasi' => $request->lokasi ?? null,
                'permasalahan' => $request->permasalahan ?? null,
                'improvment' => $request->improvment ?? null,
                'biaya' => $request->biaya ?? null,
                'uraian_biaya' => $request->uraian_biaya ?? null,
                'cost_saving' => $request->cost_saving ?? null,
                'keuntungan' => $request->keuntungan ?? null,
                'status' => 'draft',
                'kondisi_sebelum' => $request->has('kondisi_sebelum') ? (new UploadToMinioService)->handle($request->kondisi_sebelum, 'ss') : null,
                'kondisi_sesudah' => $request->has('kondisi_sesudah') ? (new UploadToMinioService)->handle($request->kondisi_sesudah, 'ss') : null,
                'approval' => 100,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'success submit draft',
                'redirect' => route('v1.ss.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error creating suggestion system: ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
