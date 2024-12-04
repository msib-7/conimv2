<?php

namespace App\Services\Osr;

use App\Events\NotificationEvent;
use App\Models\System\OneSheetReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OsrDeleteToDBService.
 */
class OsrDeleteToDBService
{
    public function handle($id)
    {
        $data = OneSheetReport::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
            // 'status' => 'draft'
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'OSR sudah publish dan tidak bisa dihapus'
            ]);
        }

        if ($data->approval == 500) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'OSR Tidak Bisa dihapus Karena Sudah Publish'
            ]);
        }

        try {
            DB::beginTransaction();

            event(new NotificationEvent(
                auth()->user()->id,
                'Delete One Sheet Report',
                'Terima Kasih Menghapus Data One Sheet Report',
                route('v1.osr.index')
            ));

            $data->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'OSR Berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error Delete OSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
