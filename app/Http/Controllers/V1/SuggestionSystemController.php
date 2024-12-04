<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\System\HistorySuggestionSystem;
use App\Models\System\SuggestionSystem;
use App\Services\Ss\SsDeleteToDbService;
use App\Services\Ss\SsGetIndexToDbService;
use App\Services\Ss\SsHistoryService;
use App\Services\Ss\SsSubmitDraftToDbService;
use App\Services\Ss\SsSubmitToDbService;
use App\Services\Ss\SsUpdateDraftToDbService;
use App\Services\Ss\SsUpdateToDbService;
use App\Services\System\GetMachineService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SuggestionSystemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new SsGetIndexToDbService)->handle();
        }

        return view('v1.ss.operator.index');
    }

    public function create()
    {
        return view('v1.ss.operator.create');
    }

    public function edit($id, Request $request)
    {
        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history', 'mesin', 'pemohon')
            ->find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('v1.ss.index')->with('galat', 'Suggestion System Tidak Tersedia');
        }

        // Cek apakah code yang di-return adalah yang sesuai
        if (in_array($data->statusApproval->code, [102, 202, 302, 402])) {
            // Jika status return, balikan ke view edit
            return view('v1.ss.operator.edit', compact('data'));
        } elseif ($data->status == 'draft') {
            return view('v1.ss.operator.edit', compact('data'));
        } else {
            // Jika status tidak dalam revisi, redirect dengan pesan error


            if ($request->ajax()) {
                return (new SsHistoryService)->handle($data);
            }
            return view('v1.ss.operator.show', compact('data'));
        }
    }

    public function update($id, Request $request)
    {
        $data = SuggestionSystem::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->first();

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Contact MSTD 404'
            ]);
        }

        if ($request->draft == 'enabled') {
            # code...
            return (new SsUpdateDraftToDbService)->handle($request, $data);
        } else {
            # code...
            return (new SsUpdateToDbService)->handle($request, $data);
        }
    }

    public function machine(Request $request)
    {
        return (new GetMachineService)->handle($request);
    }

    public function store(Request $request)
    {
        if ($request->draft == 'enabled') {
            # code...
            return (new SsSubmitDraftToDbService)->handle($request);
        } else {
            # code...
            return (new SsSubmitToDbService)->handle($request);
        }
    }

    public function destroy($id)
    {
        return (new SsDeleteToDbService)->handle($id);
    }
}
