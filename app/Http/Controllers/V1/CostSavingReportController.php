<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\System\CostSavingReport;
use App\Services\Csr\CsrDeleteToDbService;
use App\Services\Csr\CsrDraftToDbService;
use App\Services\Csr\CsrGetIndexToDbService;
use App\Services\Csr\CsrHistoryService;
use App\Services\Csr\CsrSubmitToDbService;
use App\Services\Csr\CsrUpdateDraftToDbService;
use App\Services\Csr\CsrUpdateToDbService;
use Illuminate\Http\Request;

class CostSavingReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new CsrGetIndexToDbService)->handle();
        }

        return view('v1.csr.spv.index');
    }

    public function create()
    {
        return view('v1.csr.spv.create');
    }

    public function store(Request $request)
    {
        if ($request->draft == "enabled") {
            # code...
            $request->validate([
                'tema' => 'required'
            ]);

            return (new CsrDraftToDbService)->handle($request);
        } else {
            # code...
            $request->validate([
                'tema' => 'required',
                'cost_saving' => 'required|numeric',
                'lampiran' => 'required|file|mimes:pdf|max:3072', // Maksimum 3 MB
                'sebelum' => 'required',
                'sesudah' => 'required'
            ]);
            return (new CsrSubmitToDbService)->handle($request);
        }
    }

    public function edit($id, Request $request)
    {
        $data = CostSavingReport::query()
            ->with('statusApproval', 'history', 'pemohon')
            ->find($id);

        if (empty($data)) {
            # code...
            return redirect()->route('v1.csr.index')->with('galat', 'Suggestion System Tidak Tersedia');
        }

        // Cek apakah code yang di-return adalah yang sesuai
        if (in_array($data->statusApproval->code, [102, 202, 302, 402])) {
            // Jika status return, balikan ke view edit
            return view('v1.csr.spv.edit', compact('data'));
        } elseif ($data->status == 'draft') {
            return view('v1.csr.spv.edit', compact('data'));
        } else {
            // Jika status tidak dalam revisi, redirect dengan pesan error
            if ($request->ajax()) {
                return (new CsrHistoryService)->handle($data);
            }
            return view('v1.csr.spv.show', compact('data'));
        }
    }

    public function update($id, Request $request)
    {
        $data = CostSavingReport::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Contact MSTD 404'
            ]);
        }

        if ($request->draft == "enabled") {
            # code...
            return (new CsrUpdateDraftToDbService)->handle($request, $data);
        } else {
            # code...
            return (new CsrUpdateToDbService)->handle($request, $data);
        }
    }

    public function destroy($id)
    {
        return (new CsrDeleteToDbService)->handle($id);
    }
}
