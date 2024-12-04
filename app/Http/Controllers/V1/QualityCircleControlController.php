<?php

namespace App\Http\Controllers\V1;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\System\QualityCircleControl;
use App\Models\System\TeamQualityCircleControl;
use App\Models\System\TimelineQualityCircleControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class QualityCircleControlController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QualityCircleControl::query()
                ->with('statusApproval')
                ->orderBy('tema', 'ASC')
                ->where('user_id', auth()->user()->id)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn_1 = '<a href="' . route('v1.qcc.edit', $row->id) . '" class="btn btn-sm btn-warning editPost"><i class="ti ti-eye f-20"></i></a>';
                    $btn_2 = ' <a href="' . route('v1.qcc.progress.index', $row->id) . '" class="btn btn-sm btn-info editPost"><i class="ti ti-flag f-20"></i></a>';
                    $btn = $btn_1 . $btn_2 . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('v1.qcc.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-sm btn-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                    return $btn;
                })
                ->addColumn('approvalnya', function ($row) {
                    return $row->statusApproval->description;
                })

                ->rawColumns(['action', 'approvalnya'])
                ->make(true);
        }
        return view('v1.qcc.operator.index');
    }

    public function create()
    {
        return view('v1.qcc.operator.create');
    }

    public function hrisGetEmployee(Request $request)
    {
        // $users = User::where('fullname', 'like', '%' . $request->q . '%')->get();
        $text = 'https://api-pharma.kalbe.co.id/v1/ListUsers/Name?SearchbyName=' . $request->q;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-API-Key' => 'SQA45CsPgqRCeyoO0ZzeKK6BFG1vpR1vy7r-gvPiEw4',
        ])->get($text);
        $response = $response->json();

        $data = [];
        foreach ($response as $item) {
            # code...
            $data[] = [
                'id' => $item['EmpID'],
                'fullname' => $item['EmployeeName'],
                'email' => $item['EmpEmail'],
                'phone' => $item['EmpHandPhone'] ?? 'NA',
                'jobTitle' => $item['JobTtlName'],
                'subDept' => $item['OrgName'],
                'dept' => $item['OrgGroupName'],
            ];
        }

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        $qcc = QualityCircleControl::create([
            'user_id' => auth()->user()->id,
            'fasilitator' => auth()->user()->result['SuperiorNIK'],
            'tema' => $request->tema,
            'team' => $request->team,
            'jumlah_tema' => $request->jumlah,
            'status' => 'publish',
            'approval' => 101,
        ]);

        $result_sekretaris = explode(' - ', $request->sekretaris);
        
        TeamQualityCircleControl::create([
            'user_id' => auth()->user()->id,
            'quality_circle_control_id' => $qcc->id,
            'type' => 'sekretaris',
            'member' => $result_sekretaris[0],
            'fullname' => $result_sekretaris[1],
        ]);

        foreach ($request->anggota as $anggota) {
            # code...
            $result_anggota = explode(' - ', $anggota);
            // dd($result_anggota);
            TeamQualityCircleControl::create([
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'type' => 'anggota',
                'member' => $result_anggota[0],
                'fullname' => $result_anggota[1],
            ]);
        }

        TimelineQualityCircleControl::insert([
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 1 - Latar Belakang & Menentukan Tema',
                'plan_start' => $request->mulai_1,
                'plan_end' => $request->selesai_1,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 2 - Menentukan Target',
                'plan_start' => $request->mulai_2,
                'plan_end' => $request->selesai_2,
                'status' => 'onprogres'

            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 3 - Analisa Kondisi Yang Ada',
                'plan_start' => $request->mulai_3,
                'plan_end' => $request->selesai_3,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 4 - Analisa Sebab Akibat',
                'plan_start' => $request->mulai_4,
                'plan_end' => $request->selesai_4,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 5 - Rencana Penanggulangan',
                'plan_start' => $request->mulai_5,
                'plan_end' => $request->selesai_5,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 6 - Penanggulangan',
                'plan_start' => $request->mulai_6,
                'plan_end' => $request->selesai_6,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 7 - Evaluasi Hasil',
                'plan_start' => $request->mulai_7,
                'plan_end' => $request->selesai_7,
                'status' => 'onprogres'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'quality_circle_control_id' => $qcc->id,
                'step' => 'Step 8 - Standarisasi dan Tindak Lanjut',
                'plan_start' => $request->mulai_8,
                'plan_end' => $request->selesai_8,
                'status' => 'onprogres'
            ],
        ]);

        event(new NotificationEvent(
            auth()->user()->id,
            'Added QCC Teams',
            'Terima Kasih membuat QCC pada team anda',
            route('v1.qcc.index')
        ));

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih Telah Membuat QCC',
            'redirect' => route('v1.qcc.index')
        ]);
    }

    public function edit($id)
    {
        $data = QualityCircleControl::query()
            ->with('statusApproval', 'history', 'pemohon')
            ->find($id);
        if (empty($data)) {
            # code...
            return redirect()->route('v1.qcc.index')->with('galat', 'Quality Circle Control Tidak Tersedia');
        }

        // Cek apakah code yang di-return adalah yang sesuai
        if (in_array($data->statusApproval->code, [102, 202, 302, 402])) {
            // Jika status return, balikan ke view edit
            return view('v1.qcc.operator.update', compact('data'));
        } else {
            // Jika status tidak dalam revisi, redirect dengan pesan error
            return view('v1.qcc.operator.show', compact('data'));
        }
    }

    public function destroy($id)
    {
        $data = QualityCircleControl::find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'QCC Tidak Ada'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'QCC Berhasil dihapus'
        ]);
    }
}
