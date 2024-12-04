<?php

namespace App\Services\Csr;

use App\Models\System\HistoryCostSavingReport;
use Yajra\DataTables\DataTables;

/**
 * Class CsrHistoryService.
 */
class CsrHistoryService
{
    public function handle($data)
    {
        $history = HistoryCostSavingReport::query()
            ->with('statusApproval', 'user')
            ->where('cost_saving_report_id', $data->id)->get();
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
                return $row->user ? $row->user->fullname : 'NA';
            })

            ->rawColumns(['approvalnya', 'users'])
            ->make(true);
    }
}
