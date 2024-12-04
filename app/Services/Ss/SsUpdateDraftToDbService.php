<?php

namespace App\Services\Ss;

use App\Events\NotificationEvent;
use App\Models\System\HistorySuggestionSystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SsUpdateDraftToDbService.
 */
class SsUpdateDraftToDbService
{
    public function handle($request, $data)
    {
        try {
            DB::beginTransaction();
            $data->update([
                'tema' => $request->tema,
                'lokasi' => $request->tema,
                'permasalahan' => $request->permasalahan,
                'improvment' => $request->improvment,
                'biaya' => $request->biaya,
                'uraian_biaya' => $request->uraian_biaya,
                'cost_saving' => $request->cost_saving,
                'keuntungan' => $request->keuntungan,
                'approval' => 100,
                'status' => 'draft',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Draft Telah disimpan kembali',
                'redirect' => route('v1.ss.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error Update Draft SS : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
