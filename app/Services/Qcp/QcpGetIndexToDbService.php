<?php

namespace App\Services\Qcp;

use App\Models\System\QualityCircleProject;
use Yajra\DataTables\DataTables;

/**
 * Class QcpGetIndexToDbService.
 */
class QcpGetIndexToDbService
{
    public function handle()
    {
        $data = QualityCircleProject::query()
            ->with('statusApproval')
            ->orderBy('tema', 'ASC')
            ->where('user_id', auth()->user()->id)
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn_1 = '<a href="' . route('v1.qcp.edit', $row->id) . '" class="avtar avtar-s btn-link-info editPost"><i class="ti ti-eye f-20"></i></a>';
                $btn = $btn_1 . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('v1.qcp.destroy', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                return $btn;
            })
            ->addColumn('savings', function ($row) {
                return $row->cost_saving ?? '-';
            })
            ->addColumn('status', function ($row) {
                if ($row->status === 'draft') {
                    return '<span class="badge bg-danger">Draft</span>';
                } elseif ($row->status === 'publish') {
                    return '<span class="badge bg-success">Publish</span>';
                }
            })
            ->addColumn('approvalnya', function ($row) {
                return $row->statusApproval->description;
            })

            ->rawColumns(['action', 'approvalnya', 'status'])
            ->make(true);
    }
}
