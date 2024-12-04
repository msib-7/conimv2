<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\System\QualityCircleProject;
use App\Services\Qcp\QcpDeleteToDbService;
use App\Services\Qcp\QcpGetIndexToDbService;
use App\Services\Qcp\QcpHistoryService;
use App\Services\Qcp\QcpSubmitDraftToDbService;
use App\Services\Qcp\QcpSubmitToDbService;
use App\Services\Qcp\QcpUpdateDraftToDbService;
use App\Services\Qcp\QcpUpdateToDbService;
use App\Services\System\GetHrisEmployeeService;
use Illuminate\Http\Request;

class QualityCircleProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new QcpGetIndexToDbService)->handle();
        }

        return view('v1.qcp.manager.index');
    }

    public function create()
    {
        return view('v1.qcp.manager.create');
    }

    public function hrisGetEmployee(Request $request)
    {
        return (new GetHrisEmployeeService)->handle($request);
    }

    public function store(Request $request)
    {
        if ($request->draft == 'enabled') {
            # code...
            $request->validate([
                'tema' => 'required',
                'teams' => 'required',
            ]);
            return (new QcpSubmitDraftToDbService)->handle($request);
        } else {
            # code...
            return (new QcpSubmitToDbService)->handle($request);
        }
    }

    public function update($id, Request $request)
    {
        $data = QualityCircleProject::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Contact MSTD 404'
            ]);
        }

        if (!in_array($data->statusApproval->code, [102, 202, 302, 402, 100])) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Dalam Revisi'
            ]);
        }

        if ($request->draft == 'enabled') {
            # code...
            $request->validate([
                'tema' => 'required|string',
                'teams' => 'required|string',
            ]);

            return (new QcpUpdateDraftToDbService)->handle($data, $request);
        } else {
            # code...
            $request->validate([
                'tema' => 'required',
                'cost_saving' => 'required|numeric',
                'lampiran' => 'file|mimes:pdf|max:3072', // Maksimum 3 MB
                'sebelum' => 'required',
                'sesudah' => 'required',
            ]);
            return (new QcpUpdateToDbService)->handle($data, $request);
        }
    }

    public function edit($id, Request $request)
    {
        $data = QualityCircleProject::query()
            ->with('statusApproval', 'history', 'pemohon', 'team')
            ->find($id);

        // dd($data);

        if (empty($data)) {
            # code...
            return redirect()->route('v1.qcp.index')->with('galat', 'Quality Circle Project Tidak Tersedia');
        }

        // Cek apakah code yang di-return adalah yang sesuai
        if (in_array($data->statusApproval->code, [102, 202, 302, 402])) {
            // Jika status return, balikan ke view edit
            return view('v1.qcp.manager.edit', compact('data'));
        } elseif ($data->status == 'draft') {
            return view('v1.qcp.manager.edit', compact('data'));
        } else {
            // Jika status tidak dalam revisi, redirect dengan pesan error
            // Jika status tidak dalam revisi, redirect dengan pesan error
            if ($request->ajax()) {
                return (new QcpHistoryService)->handle($data);
            }
            return view('v1.qcp.manager.show', compact('data'));
        }
    }

    public function destroy($id)
    {
        return (new QcpDeleteToDbService)->handle($id);
    }
}
