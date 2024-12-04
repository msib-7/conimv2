<?php

namespace App\Services\Ss;

use App\Models\System\SuggestionSystem;

/**
 * Class SsDeleteToDbService.
 */
class SsDeleteToDbService
{
    public function handle($id)
    {
        $data = SuggestionSystem::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
            // 'status' => 'draft'
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Suggestion System sudah publish dan tidak bisa dihapus'
            ]);
        }

        if ($data->approval == 500) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Suggestion System Tidak Bisa dihapus Karena Sudah Publish'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Suggestion System Berhasil dihapus'
        ]);
    }
}
