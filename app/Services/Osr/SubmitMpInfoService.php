<?php

namespace App\Services\Osr;

use App\Models\System\MpInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SubmitMpInfoService.
 */
class SubmitMpInfoService
{
    public function handle($request, $osr)
    {

        MpInfo::create([
            'user_id' => auth()->user()->id,
            'one_sheet_report_id' => $osr->id,
            'mesin_id' => $request->mesin,
            'ketegori' => $request->kategoriMPInfo,
            'section_mesin' => $request->sectionMesin,
            'jenis_mesin' => $request->jenisMesin,
            'alasan' => $request->alasan ?? null,
            'detail' => $request->infoDetail ?? null,
            'sebelumPerubahan' => $request->sebelumPerubahan ?? null,
            'setelahPerubahan' => $request->setelahPerubahan ?? null,
        ]);
        //     try {
        //         DB::beginTransaction();
        //         MpInfo::create([
        //             'user_id' => auth()->user()->id,
        //             'one_sheet_report_id' => $osr->id,
        //             'mesin_id' => $request->mesin,
        //             'fasilitator' => auth()->user()->result['SuperiorNIK'],
        //             'ketegori' => $request->kategoriMPInfo,
        //             'section_mesin' => $request->sectionMesin,
        //             'jenis_mesin' => $request->jenisMesin ?? null,
        //             'alasan' => $request->alasan ?? null,
        //             'detail' => $request->infoDetail ?? null,
        //             'sebelumPerubahan' => $request->sebelumPerubahan ?? null,
        //             'setelahPerubahan' => $request->setelahPerubahan ?? null,
        //         ]);
        //         DB::commit();
        //     } catch (\Throwable $th) {
        //         DB::rollBack();

        //         // Log error untuk debugging
        //         Log::error('Error MP Info : ' . $th->getMessage());
        //     }
    }
}
