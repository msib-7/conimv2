<?php

namespace App\Services\Ss;

use App\Events\NotificationEvent;
use App\Models\System\HistorySuggestionSystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SsUpdateToDbService.
 */
class SsUpdateToDbService
{
    public function handle($request, $data)
    {
        if (!in_array($data->statusApproval->code, [102, 202, 302, 402, 100])) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Dalam Revisi'
            ]);
        }

        $request->validate([
            'tema' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'mesin' => 'required',
            'permasalahan' => 'required|string',
            'improvment' => 'required|string',
            'biaya' => 'required|numeric',
            'uraian_biaya' => 'required|string',
            'cost_saving' => 'required|numeric',
            'keuntungan' => 'required|string',
            // 'kondisi_sebelum' => '|mimes:jpg,jpeg|max:3072', // Max 3 MB dan tipe file jpg, jpeg, pdf
            // 'kondisi_sesudah' => '|mimes:jpg,jpeg|max:3072',  // Max 3 MB dan tipe file jpg, jpeg, pdf
        ]);

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
                'approval' => 101,
                'status' => 'publish'
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $data->id,
                'status' => 101
            ]);

            event(new NotificationEvent(
                auth()->user()->id,
                'Return Suggestion System',
                'Terima Kasih Update Revisi Suggestion System Anda',
                route('v1.ss.index')
            ));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Telah Melakukan Revisi',
                'redirect' => route('v1.ss.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error Update SS : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
