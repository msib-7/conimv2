<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\System\MpInfo;
use App\Services\MpInfo\GetDataIndexService;
use Illuminate\Http\Request;

class MpInfoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new GetDataIndexService)->handle();
        }

        return view('v1.mpinfo.index');
    }
    public function show($id)
    {
        $data = MpInfo::find($id);
        return view('v1.mpinfo.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = MpInfo::find($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih Menghapus Mp Info',
            'redirect' => route('v1.mpinfo.index')
        ]);
    }
}
