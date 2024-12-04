<?php

namespace App\Services\Osr;

use App\Events\NotificationEvent;
use App\Models\System\HistoryOneSheetReport;
use App\Models\System\OneSheetReport;
use App\Services\System\ApprovalMailService;
use App\Services\System\GetFasilitatorService;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OsrStoreToDBService.
 */
class OsrStoreToDBService
{
    public function handle($request)
    {
        $request->validate([
            'tema' => 'required',
            'lokasi' => 'required',
            'mesin' => 'required',
            'specific' => 'required',
            'measurable' => 'required',
            'achievable' => 'required',
            'reasonable' => 'required',
            'timeBased' => 'required',
            'manWSBH' => 'required',
            'manWAH' => 'required',
            'machineWSBH' => 'required',
            'machineWAH' => 'required',
            'methodWSBH' => 'required',
            'methodWAH' => 'required',
            'materialWSBH' => 'required',
            'materialWAH' => 'required',
            'environmentWSBH' => 'required',
            'environmentWAH' => 'required',
            'what' => 'required',
            'who' => 'required',
            'why' => 'required',
            'where' => 'required',
            'when' => 'required',
            'how' => 'required',
            'quality' => 'required',
            'cost' => 'required',
            'delivery' => 'required',
            'safety' => 'required',
            'morale' => 'required',
            'productivity' => 'required',
            'environment' => 'required',
            'standarisasi' => 'required',
            'nextStep' => 'required|string',
            'totalBiaya' => 'required|numeric',
            'lampiran' => 'required',
            'costSaving' => 'required|numeric'
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
                'lampiran' => (new UploadToMinioService)->handle($request->lampiran, 'osr'),
                'status' => 'publish',
                'approval' => 101,
            ]);

            HistoryOneSheetReport::create([
                'user_id' => auth()->user()->id,
                'one_sheet_report_id' => $osr->id,
                'status' => 101
            ]);

            if ($request->mp_info == "enabled") {
                (new SubmitMpInfoService)->handle($request, $osr);
            }

            event(new NotificationEvent(
                auth()->user()->id,
                'Added One Sheet Report',
                'Terima Kasih Telah Membuat One Sheet Report',
                route('v1.osr.index')
            ));

            $fasilitator = (new GetFasilitatorService)->hrisGetEmployee(auth()->user()->result['SuperiorNIK']);
            $message = 'Halo anda baru saja menerima permintaan persetujuan One Sheet Report yang telah dibuat oleh ' . auth()->user()->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Approval Fasilitator',
                'link' => route('v1.approval.fasilitator.osr.index'),
                'penerima' => $fasilitator[0]['fullname'],
                'body' => $message
            ];

            (new ApprovalMailService)->handle($fasilitator[0]['email'], $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih Mensubmit OSR',
                'redirect' => route('v1.osr.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error creating OSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
