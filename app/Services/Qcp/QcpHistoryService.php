<?php

namespace App\Services\Qcp;

use App\Models\System\HistoryQualityCircleProject;
use Yajra\DataTables\DataTables;

/**
 * Class QcpHistoryService.
 */
class QcpHistoryService
{
    public function handle($data)
    {
        $history = HistoryQualityCircleProject::query()
            ->with('statusApproval', 'user')
            ->where('quality_circle_project_id', $data->id)->get();
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
