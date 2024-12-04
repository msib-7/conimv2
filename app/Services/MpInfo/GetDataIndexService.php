<?php

namespace App\Services\MpInfo;

use App\Models\System\MpInfo;
use Yajra\DataTables\DataTables;

/**
 * Class GetDataIndexService.
 */
class GetDataIndexService
{
    public function handle()
    {
        $data = MpInfo::query()
            ->orderBy('ketegori', 'ASC')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn_1 = '<a href="' . route('v1.mpinfo.show', $row->id) . '" class="avtar avtar-s btn-link-info"><i class="ti ti-eye f-20"></i></a>';
                $btn = $btn_1 . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('v1.mpinfo.destroy', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                return $btn;
            })
            ->addColumn('ss', function ($row) {
                return 'Terdapat Pada SS';
            })

            ->addColumn('osr', function ($row) {
                return 'Terdapat Pada OSR';
            })

            ->rawColumns(['action', 'ss', 'osr'])
            ->make(true);
    }
}
