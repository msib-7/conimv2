<?php

namespace App\Services\Osr;

use App\Models\System\HistoryOneSheetReport;
use Yajra\DataTables\DataTables;

/**
 * Class OsrHistoryService.
 */
class OsrHistoryService
{
    public function handle($data)
    {
        $history = HistoryOneSheetReport::query()
            ->with('statusApproval', 'user')
            ->where('one_sheet_report_id', $data->id)->get();
        # code...
        return DataTables::of($history)
            ->addIndexColumn()
            ->addColumn('approvalnya', function ($row) {
                if (strpos($row->statusApproval->description, 'Waiting') !== false) {
                    // Ganti "Waiting" dengan "Approval By"
                    return str_replace('Waiting', 'Approval By', $row->statusApproval->description);
                } else {
                    // Jika tidak ada "Waiting", biarkan apa adanya
                    return $row->statusApproval->description;
                }
            })
            ->addColumn('users', function ($row) {
                return $row->user->fullname;
            })

            ->rawColumns(['approvalnya', 'users'])
            ->make(true);
    }
}
