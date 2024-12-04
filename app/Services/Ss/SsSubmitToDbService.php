<?php

namespace App\Services\Ss;

use App\Events\NotificationEvent;
use App\Models\System\HistorySuggestionSystem;
use App\Models\System\SuggestionSystem;
use App\Services\System\ApprovalMailService;
use App\Services\System\GetFasilitatorService;
use App\Services\System\UploadToMinioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SsSubmitToDbService.
 */
class SsSubmitToDbService
{
    public function handle($request)
    {
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
            'kondisi_sebelum' => 'mimes:jpg,jpeg,png|max:3072', // Max 3 MB dan tipe file jpg, jpeg, pdf
            'kondisi_sesudah' => 'mimes:jpg,jpe,png|max:3072',  // Max 3 MB dan tipe file jpg, jpeg, pdf
        ]);

        try {
            DB::beginTransaction();

            $ss = SuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'mesin_id' => $request->mesin,
                'fasilitator' => auth()->user()->result['SuperiorNIK'],
                'tema' => $request->tema,
                'lokasi' => $request->tema,
                'permasalahan' => $request->permasalahan,
                'improvment' => $request->improvment,
                'biaya' => $request->biaya,
                'uraian_biaya' => $request->uraian_biaya,
                'cost_saving' => $request->cost_saving,
                'keuntungan' => $request->keuntungan,
                'status' => 'publish',
                'kondisi_sebelum' => $request->has('kondisi_sebelum') ? (new UploadToMinioService)->handle($request->kondisi_sebelum, 'ss') : null,
                'kondisi_sesudah' => $request->has('kondisi_sesudah') ? (new UploadToMinioService)->handle($request->kondisi_sesudah, 'ss') : null,
                'approval' => 101,
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $ss->id,
                'status' => 101
            ]);

            event(new NotificationEvent(
                auth()->user()->id,
                'Added Suggestion System',
                'Terima Kasih Telah Membuat Suggestion System',
                route('v1.ss.index')
            ));

            $fasilitator = (new GetFasilitatorService)->hrisGetEmployee(auth()->user()->result['SuperiorNIK']);
            $message = 'Halo anda baru saja menerima permintaan persetujuan Sugestion System yang telah dibuat oleh ' . auth()->user()->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Approval Fasilitator',
                'link' => route('v1.approval.fasilitator.suggestion_System.index'),
                'penerima' => $fasilitator[0]['fullname'],
                'body' => $message
            ];

            (new ApprovalMailService)->handle($fasilitator[0]['email'], $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'success submit',
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
