<?php

namespace App\Services\Osr;

use App\Events\NotificationEvent;
use App\Models\System\HistoryOneSheetReport;
use App\Models\System\OneSheetReport;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OsrUpdateToDBService.
 */
class OsrUpdateToDBService
{
    public function handle($id, $request)
    {
        $data = OneSheetReport::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Contact MSTD 404'
            ]);
        }

        if (!in_array($data->statusApproval->code, [102, 202, 302, 402, 100])) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Dalam Revisi'
            ]);
        }

        $request->validate([
            'tema' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'mesin' => 'required',
            'specific' => 'required|string',
            'measurable' => 'required|string',
            'achievable' => 'required|string',
            'reasonable' => 'required|string',
            'timeBased' => 'required|string',
            'manWSBH' => 'required|string',
            'manWAH' => 'required|string',
            'machineWSBH' => 'required|string',
            'machineWAH' => 'required|string',
            'methodWSBH' => 'required|string',
            'methodWAH' => 'required|string',
            'materialWSBH' => 'required|string',
            'materialWAH' => 'required|string',
            'environmentWSBH' => 'required|string',
            'environmentWAH' => 'required|string',
            'what' => 'required|string',
            'who' => 'required|string',
            'why' => 'required|string',
            'where' => 'required|string',
            'when' => 'required|string',
            'how' => 'required|string',
            'quality' => 'required|string',
            'cost' => 'required|string',
            'delivery' => 'required|string',
            'safety' => 'required|string',
            'morale' => 'required|string',
            'productivity' => 'required|string',
            'environment' => 'required|string',
            'standarisasi' => 'required|string',
            'nextStep' => 'required|string',
            'totalBiaya' => 'required|numeric',
            'costSaving' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();

            $data->update([
                'tema' => $request->tema,
                'lokasi' => $request->lokasi,
                'nomorCC' => $request->noCC ?? null,
                'smart_specific' => $request->specific,
                'smart_measurable' => $request->measurable,
                'smart_achievable' => $request->achievable,
                'smart_reasonable' => $request->reasonable,
                'smart_time' => $request->timeBased,
                'man_WSBH' => $request->manWSBH,
                'man_WAH' => $request->manWAH,
                'man_root_cause' => $request->man_root_cause,
                'machine_WSBH' => $request->machineWSBH,
                'machine_WAH' => $request->machineWAH,
                'machine_root_cause' => $request->machine_root_cause,
                'method_WSBH' => $request->methodWSBH,
                'method_WAH' => $request->methodWAH,
                'method_root_cause' => $request->method_root_cause,
                'material_WSBH' => $request->materialWSBH,
                'material_WAH' => $request->materialWAH,
                'material_root_cause' => $request->material_root_cause,
                'environment_WSBH' => $request->environmentWSBH,
                'environment_WAH' => $request->environmentWAH,
                'environment_root_cause' => $request->environment_root_cause,
                'what' => $request->what,
                'who' => $request->who,
                'why' => $request->why,
                'where' => $request->where,
                'when' => $request->when,
                'how' => $request->how,
                'quality' => $request->quality,
                'cost' => $request->cost,
                'delivery' => $request->delivery,
                'safety' => $request->safety,
                'morale' => $request->morale,
                'productivity' => $request->productivity,
                'environment' => $request->environment,
                'standarisasi' => $request->standarisasi,
                'nextStep' => $request->nextStep,
                'biaya' => $request->totalBiaya,
                'costSaving' => $request->costSaving,
                'approval' => 101,
                'status' => 'publish',
            ]);

            if ($request->lampiran) {
                # code...
                $data->update([
                    'lampiran' => (new UploadToMinioService)->handle($request->lampiran, 'osr'),
                ]);
            }

            HistoryOneSheetReport::create([
                'user_id' => auth()->user()->id,
                'one_sheet_report_id' => $data->id,
                'status' => 101
            ]);

            event(new NotificationEvent(
                auth()->user()->id,
                'Return OneSheetReport',
                'Terima Kasih Update Revisi OneSheetReport Anda',
                route('v1.osr.index')
            ));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Telah Melakukan Revisi',
                'redirect' => route('v1.osr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error creating OSR UPDATE : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
