<?php

namespace App\Services\Ss;
use App\Models\System\MpInfo;

/**
 * Class SubmitMpInfoService.
 */
class SubmitMpInfoService
{

    public function handle($request, $data)
    {

        MpInfo::create([
            'user_id' => auth()->user()->id,
            'suggestion_system_id' => $data->id,
            'mesin_id' => $data->mesin_id,
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
