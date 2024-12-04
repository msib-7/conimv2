<?php

namespace App\Services\Osr;

use App\Models\System\OneSheetReport;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OsrSubmitDraftToDbService.
 */
class OsrSubmitDraftToDbService
{
    public function handle($request)
    {
        $request->validate([
            'tema' => 'required',
            'mesin' => 'required',
            'lokasi'
        ]);

        try {
            DB::beginTransaction();

            $osr = OneSheetReport::create([
                'user_id' => auth()->user()->id,
                'mesin_id' => $request->mesin,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'lokasi' => $request->lokasi,
                'nomorCC' => $request->noCC ?? null,
                'smart_specific' => $request->specific ?? null,
                'smart_measurable' => $request->measurable ?? null,
                'smart_achievable' => $request->achievable ?? null,
                'smart_reasonable' => $request->reasonable ?? null,
                'smart_time' => $request->timeBased ?? null,
                'man_WSBH' => $request->manWSBH ?? null,
                'man_WAH' => $request->manWAH ?? null,
                'man_root_cause' => $request->man_root_cause ?? null,
                'machine_WSBH' => $request->machineWSBH ?? null,
                'machine_WAH' => $request->machineWAH ?? null,
                'machine_root_cause' => $request->machine_root_cause ?? null,
                'method_WSBH' => $request->methodWSBH ?? null,
                'method_WAH' => $request->methodWAH ?? null,
                'method_root_cause' => $request->method_root_cause ?? null,
                'material_WSBH' => $request->materialWSBH ?? null,
                'material_WAH' => $request->materialWAH ?? null,
                'material_root_cause' => $request->material_root_cause ?? null,
                'environment_WSBH' => $request->environmentWSBH ?? null,
                'environment_WAH' => $request->environmentWAH ?? null,
                'environment_root_cause' => $request->environment_root_cause ?? null,
                'what' => $request->what ?? null,
                'who' => $request->who ?? null,
                'why' => $request->why ?? null,
                'where' => $request->where ?? null,
                'when' => $request->when ?? null,
                'how' => $request->how ?? null,
                'quality' => $request->quality ?? null,
                'cost' => $request->cost ?? null,
                'delivery' => $request->delivery ?? null,
                'safety' => $request->safety ?? null,
                'morale' => $request->morale ?? null,
                'productivity' => $request->productivity ?? null,
                'environment' => $request->environment ?? null,
                'standarisasi' => $request->standarisasi ?? null,
                'nextStep' => $request->nextStep ?? null,
                'biaya' => $request->totalBiaya ?? null,
                'costSaving' => $request->costSaving ?? null,
                'lampiran' => $request->has('lampiran') ? (new UploadToMinioService)->handle($request->lampiran, 'osr') : null,
                'status' => 'draft',
                'approval' => 100,
            ]);



            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Mensubmit OSR',
                'redirect' => route('v1.osr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error draft OSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
