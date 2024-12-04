<?php

namespace App\Http\Controllers\Approval\MstdOfficer;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\RejectApproval;
use App\Models\System\CategorySaving;
use App\Models\System\HistorySuggestionSystem;
use App\Models\System\SuggestionSystem;
use App\Models\System\UserMstdOfficer;
use App\Models\System\UserMstdSpv;
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
        // dd($data);
        if ($request->ajax()) {
            $data = SuggestionSystem::query()
                ->with('pemohon')
                ->where('approval', 201)
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline text-center mb-0">
                                                <li class="list-inline-item align-bottom"
                                                    title="View">
                                                    <a href="' . route('v1.mstdOfficer.suggestionSystem.show', $row->id) . '"
                                                        class="btn btn-sm btn-outline-secondary" style="border-radius: 5px;">
                                                       <i class="ti ti-edit f-18"></i> View Approval
                                                    </a>
                                                </li>
                                            </ul>';
                    return $btn;
                })
                ->addColumn('status_approval', function ($row) {
                    return 'Waiting Approval';
                })
                ->addColumn('users', function ($row) {
                    return $row->pemohon->fullname;
                })
                ->addColumn('savings', function ($row) {
                    if ($row->cost_saving <= 0) {
                        # code...
                        return 'No Savings';
                    } else {
                        # code...
                        return 'Savings';
                    }
                })
                ->rawColumns(['action', 'status_approval', 'savings', 'users'])
                ->make(true);
        }

        return view('v1.ss.mstdOfficer.index');
    }

    public function show($id)
    {
        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history', 'mesin', 'pemohon')
            ->where([
                'id' => $id,
                'approval' => 201,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return back()->with('galat', 'Error Approval, Data Not Found');
        }

        $cat_saving = CategorySaving::latest()->get();
        return view('v1.ss.mstdOfficer.show', compact('data', 'cat_saving'));
    }

    public function store($id, Request $request)
    {
        $data = SuggestionSystem::query()
            ->with('statusApproval', 'history')
            ->where([
                'id' => $id,
                'approval' => 201,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Error Approval, Data Not Found',
            ]);
        }

        if ($request->status == "approve") {
            # code...
            return $this->berhasil($data, $request);
        } else {
            # code...
            $request->validate([
                'note' => 'required'
            ]);

            return $this->balikan($data, $request);
        }
    }

    private function berhasil($data, $request)
    {
        if ($data->cost_saving > 0) {
            # code...
            $request->validate([
                'cat_saving' => 'required',
            ]);
        }

        try {
            DB::beginTransaction();

            $data->update([
                'category_saving_id' => $request->cat_saving,
                'nomorSS' => $request->nomorSS,
                'approval' => 301
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $data->id,
                'status' => 301
            ]);

            event(new NotificationEvent(
                $data->user_id,
                'Success Approval MSTD Officer',
                'Suggestion System telah disetujui oleh MSTD Officer ' . auth()->user()->fullname,
                route('v1.ss.index')
            ));

            $message = 'Halo anda baru saja menerima permintaan persetujuan Suggestion System yang telah dibuat oleh ' . $data->pemohon->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Approval MSTD SPV',
                'link' => route('v1.mstdSpv.suggestionSystem.index'),
                'penerima' => 'MSTD SPV',
                'body' => $message
            ];
            $mstdOfficer = UserMstdSpv::pluck('email');
            (new ApprovalMailService)->handle($mstdOfficer, $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Approval',
                'redirect' => route('v1.mstdOfficer.suggestionSystem.index')
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

    private function balikan($data, $request)
    {
        try {
            DB::beginTransaction();

            $data->update([
                'approval' => 202
            ]);

            HistorySuggestionSystem::create([
                'user_id' => auth()->user()->id,
                'suggestion_system_id' => $data->id,
                'status' => 202,
                'note' => $request->note
            ]);

            // Buat NOtifikasi Ke USers
            event(new NotificationEvent(
                $data->user_id,
                'Success Return MSTD Officer',
                'Suggestion System telah return oleh MSTD Officer ' . auth()->user()->fullname,
                route('v1.ss.index')
            ));

            $message = 'Halo, Persetujuan anda Suggestion System telah dikembalikan dengan catatan : ' . $request->note . ' , Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Return By MSTD Officer',
                'link' => route('v1.ss.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new RejectApproval($email));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Return',
                'redirect' => route('v1.mstdOfficer.suggestionSystem.index')
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
