<?php

namespace App\Http\Controllers\Approval\Fasilitator;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\RejectApproval;
use App\Models\System\CategoryCorporate;
use App\Models\System\CategoryImpactTo;
use App\Models\System\CategorySaving;
use App\Models\System\CategorySavingSpv;
use App\Models\System\HistorySuggestionSystem;
use App\Models\System\SuggestionSystem;
use App\Models\System\UserMstdOfficer;
use App\Services\Ss\SubmitMpInfoService;
use App\Services\System\ApprovalMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class SuggestionSystemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SuggestionSystem::query()
                ->with('statusApproval')
                ->orderBy('tema', 'ASC')
                ->where([
                    'approval' => 101,
                    'fasilitator' => auth()->user()->employeId
                ])
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('v1.approval.fasilitator.suggestion_System.show', $row->id) . '" class="btn btn-success"><i class="ti ti-eye f-20"></i> Show More</a>';
                    return $btn;
                })
                ->addColumn('approvalnya', function ($row) {
                    return $row->statusApproval->description;
                })

                ->rawColumns(['action', 'approvalnya'])
                ->make(true);
        }

        return view('v1.ss.fasilitator.index');
    }

    public function show($id)
    {
        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history', 'mesin', 'pemohon')
            ->where([
                'id' => $id,
                'approval' => 101,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return redirect()->route('v1.ss.index')->with('galat', 'Suggestion System Tidak Tersedia');
        }

        // Improvment
        $cat_improvment = CategorySavingSpv::latest()->get();
        $cat_corp = CategoryCorporate::latest()->get();
        $cat_impact = CategoryImpactTo::latest()->get();

        return view('v1.ss.fasilitator.show', compact('data', 'cat_improvment', 'cat_impact', 'cat_corp'));
    }

    public function store(Request $request, $id)
    {
        if ($request->status == "approve") {
            # code...
            if ($request->mp_info == "enabled") {
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
            return $this->berhasil($request, $id);
        } else {
            # code...
            return $this->balikan($request, $id);
        }
    }

    private function berhasil($request, $id)
    {
        $request->validate([
            'cat_improvment' => 'required',
            'cat_corp' => 'required',
            'cat_impact' => 'required',
        ]);

        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history')
            ->where([
                'id' => $id,
                'approval' => 101,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Error Approval, Data Not Found',
            ]);
        }

        try {
            DB::beginTransaction();

            $data->update([
                'category_improvment_id' => $request->cat_improvment,
                'category_corporate_id' => $request->cat_corp,
                'category_impact_id' => $request->cat_impact,
                'nomorCC' => $request->nomorCC,
                'approval' => 201
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $data->id,
                'status' => 201
            ]);

            if ($request->mp_info == "enabled") {
                (new SubmitMpInfoService)->handle($request, $data);
            }

            event(new NotificationEvent(
                $data->user_id,
                'Success Approval Fasilitator',
                'Suggestion System telah disetujui oleh Fasilitator ' . auth()->user()->fullname,
                route('v1.ss.index')
            ));

            // Notif Ke MSTD OFFICER
            $message = 'Halo anda baru saja menerima permintaan persetujuan Suggestion System yang telah dibuat oleh ' . $data->pemohon->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Waiting Approval MSTD Officer',
                'link' => route('v1.mstdOfficer.suggestionSystem.index'),
                'penerima' => 'MSTD Officer',
                'body' => $message
            ];
            $mstdOfficer = UserMstdOfficer::pluck('email');
            (new ApprovalMailService)->handle($mstdOfficer, $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Approval',
                'redirect' => route('v1.approval.fasilitator.suggestion_System.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error approval suggestion system: ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }

    private function balikan($request, $id)
    {
        $request->validate([
            'note' => 'required'
        ]);

        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history')
            ->where([
                'id' => $id,
                'approval' => 101,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Error Approval, Data Not Found',
            ]);
        }

        try {
            DB::beginTransaction();

            $data->update([
                'approval' => 102
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $data->id,
                'status' => 102,
                'note' => $request->note
            ]);

            // Buat NOtifikasi Ke USers
            event(new NotificationEvent(
                $data->user_id,
                'Success Return Fasilitator',
                'Suggestion System telah return oleh Fasilitator ' . auth()->user()->fullname,
                route('v1.ss.index')
            ));

            $message = 'Halo, Persetujuan anda Suggestion System telah dikembalikan dengan catatan : ' . $request->note . ' , Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Return By Fasilitator',
                'link' => route('v1.ss.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new RejectApproval($email));
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Return',
                'redirect' => route('v1.approval.fasilitator.suggestion_System.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error return suggestion system: ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
