<?php

namespace App\Services\Csr;

use App\Models\System\CostSavingReport;

/**
 * Class CsrDeleteToDbService.
 */
class CsrDeleteToDbService
{
    public function handle($id)
    {
        $data = CostSavingReport::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
            // 'status' => 'draft'
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Cost Saving Report sudah publish dan tidak bisa dihapus'
            ]);
        }

        if ($data->approval == 500) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Cost Saving Report Tidak Bisa dihapus Karena Sudah Publish'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cost Saving Report Berhasil dihapus'
        ]);
    }
}
