<?php

namespace App\Http\Controllers\Approval\FinanceAccounting;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\FinishApproval;
use App\Mail\RejectApproval;
use App\Models\System\HistoryQualityCircleProject;
use App\Models\System\QualityCircleProject;
use App\Models\System\UserFa;
use App\Services\System\ApprovalMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class QualityCircleProjectController extends Controller
{
    public function index(Request $request)
    {
        // dd($data);
        if ($request->ajax()) {
            $data = QualityCircleProject::query()
                ->with('pemohon')
                ->where('approval', 401)
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline text-center mb-0">
                                                <li class="list-inline-item align-bottom"
                                                    title="View">
                                                    <a href="' . route('v1.financeAccounting.qcp.show', $row->id) . '"
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

        return view('v1.qcp.financeAccount.index');
    }

    public function show($id)
    {
        $data = QualityCircleProject::query()
            ->with('statusApproval', 'history', 'pemohon')
            ->where([
                'id' => $id,
                'approval' => 401,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return back()->with('galat', 'Error Approval, Data Not Found');
        }

        return view('v1.qcp.financeAccount.show', compact('data'));
    }

    public function store($id, Request $request)
    {
        $data = QualityCircleProject::query()
            ->with('statusApproval', 'history')
            ->where([
                'id' => $id,
                'approval' => 401,
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
        try {
            DB::beginTransaction();

            $data->update([
                'approval' => 500
            ]);

            HistoryQualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'quality_circle_project_id' => $data->id,
                'status' => 500
            ]);

            event(new NotificationEvent(
                $data->user_id,
                'Success Approval Finance Account',
                'QCP telah disetujui oleh Finance Account ' . auth()->user()->fullname,
                route('v1.qcp.index')
            ));

            event(new NotificationEvent(
                $data->user_id,
                'Finished Approval',
                'QCP telah Selesai dan silahkan cek kembali',
                route('v1.qcp.index')
            ));

            $message = 'Halo, Persetujuan anda sudah selesai untuk Quality Circle Project, Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Finish Approval',
                'link' => route('v1.qcp.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new FinishApproval($email));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Approval',
                'redirect' => route('v1.financeAccounting.qcp.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error approval QCP : ' . $th->getMessage());

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
                'approval' => 402
            ]);

            HistoryQualityCircleProject::create([
                'user_id' => auth()->user()->id,
                'quality_circle_project_id' => $data->id,
                'status' => 402,
                'note' => $request->note
            ]);

            // Buat NOtifikasi Ke USers
            event(new NotificationEvent(
                $data->user_id,
                'Success Return Finance Accounting',
                'QCP telah return oleh Finance Accounting ' . auth()->user()->fullname,
                route('v1.qcp.index')
            ));

            $message = 'Halo, Persetujuan anda Quality Circle Project telah dikembalikan dengan catatan : ' . $request->note . ' , Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Return By Finance Accounting',
                'link' => route('v1.qcp.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new RejectApproval($email));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Return',
                'redirect' => route('v1.financeAccounting.qcp.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error return Finance Accounting : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
