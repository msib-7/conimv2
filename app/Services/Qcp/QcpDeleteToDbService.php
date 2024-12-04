<?php

namespace App\Services\Qcp;

use App\Models\System\QualityCircleProject;

/**
 * Class QcpDeleteToDbService.
 */
class QcpDeleteToDbService
{
    public function handle($id)
    {
        $data = QualityCircleProject::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
            // 'status' => 'draft'
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Quality Circle Project sudah publish dan tidak bisa dihapus'
            ]);
        }

        if ($data->approval == 500) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Quality Circle Project Tidak Bisa dihapus Karena Sudah Publish'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quality Circle Project Berhasil dihapus'
        ]);
    }
}
