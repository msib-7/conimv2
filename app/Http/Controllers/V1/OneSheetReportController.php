<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\Osr\ShowDataOsrRepository as OsrShowDataOsrRepository;
use App\Services\Osr\DataTableService;
use App\Services\Osr\OsrDeleteToDBService;
use App\Services\Osr\OsrHistoryService;
use App\Services\Osr\OsrStoreToDBService;
use App\Services\Osr\OsrSubmitDraftToDbService;
use App\Services\Osr\OsrUpdateDraftToDBService;
use App\Services\Osr\OsrUpdateToDBService;
use App\Services\System\GetMachineService;
use Illuminate\Http\Request;

class OneSheetReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new DataTableService)->handle();
        }

        return view('v1.osr.spv.index');
    }

    public function create()
    {
        return view('v1.osr.spv.create');
    }

    public function edit($id, Request $request)
    {
        $data = (new OsrShowDataOsrRepository)->getById($id);

        if (empty($data)) {
            # code...
            return redirect()->route('v1.osr.index')->with('galat', 'One Sheet Report Tidak Tersedia');
        }


        // Cek apakah code yang di-return adalah yang sesuai
        if (in_array($data->statusApproval->code, [102, 202, 302, 402])) {
            // Jika status return, balikan ke view edit
            return view('v1.osr.spv.edit', compact('data'));
        } elseif ($data->status == 'draft') {
            return view('v1.osr.spv.edit', compact('data'));
        } else {
            // Jika status tidak dalam revisi, redirect dengan pesan error
            if ($request->ajax()) {
                return (new OsrHistoryService)->handle($data);
            }
            return view('v1.osr.spv.show', compact('data'));
        }
    }

    public function machine(Request $request)
    {
        return (new GetMachineService)->handle($request);
    }

    public function store(Request $request)
    {
       
        
        if ($request->draft == "enabled") {
            # code...
            return (new OsrSubmitDraftToDbService)->handle($request);
        } else {
            # code...

            if($request->mp_info == "enabled"){  
                $request->validate([
                    'kategoriMPInfo' => 'required',
                    'sectionMesin' => 'required',
                    'jenisMesin' => 'required',
                    'alasan' => 'required',
                    'infoDetail' => 'required',
                    'sebelumPerubahan' => 'required',
                    'setelahPerubahan' => 'required',
                ]);  
              
            } 
            return (new OsrStoreToDBService)->handle($request);
        }

        
        
    }

    public function update($id, Request $request)
    {
        if ($request->draft == "enabled") {
            # code...
            return (new OsrUpdateDraftToDBService)->handle($id, $request);
        } else {
            # code...
            return (new OsrUpdateToDBService)->handle($id, $request);
        }
    }

    public function destroy($id)
    {
        return (new OsrDeleteToDBService)->handle($id);
    }
}
