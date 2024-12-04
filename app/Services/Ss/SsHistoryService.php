<?php

namespace App\Services\Ss;

use App\Models\System\HistorySuggestionSystem;
use Yajra\DataTables\DataTables;

/**
 * Class SsHistoryService.
 */
class SsHistoryService
{
    public function handle($data)
    {
        $history = HistorySuggestionSystem::query()
            ->with('statusApproval', 'user')
            ->where('suggestion_system_id', $data->id)->get();
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
