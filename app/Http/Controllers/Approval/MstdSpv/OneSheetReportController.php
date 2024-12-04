<?php

namespace App\Http\Controllers\Approval\MstdSpv;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\RejectApproval;
use App\Models\System\CategoryJenisSaving;
use App\Models\System\HistoryOneSheetReport;
use App\Models\System\OneSheetReport;
use App\Services\System\ApprovalMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class OneSheetReportController extends Controller
{
    public function index(Request $request)
    {
        // dd($data);
        if ($request->ajax()) {
            $data = OneSheetReport::query()
                ->with('pemohon')
                ->where('approval', 301)
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="list-inline text-center mb-0">
                                                <li class="list-inline-item align-bottom"
                                                    title="View">
                                                    <a href="' . route('v1.mstdSpv.osr.show', $row->id) . '"
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
                    if ($row->costSaving <= 0) {
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

        return view('v1.osr.mstdSpv.index');
    }

    public function show($id)
    {
        $data = OneSheetReport::query()
            ->with('statusApproval', 'history', 'pemohon')
            ->where([
                'id' => $id,
                'approval' => 301,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return back()->with('galat', 'Error Approval, Data Not Found');
        }

        $jenis_saving = CategoryJenisSaving::latest()->get();
        return view('v1.osr.mstdSpv.show', compact('data', 'jenis_saving'));
    }

    public function store($id, Request $request)
    {
        $data = OneSheetReport::query()
            ->with('statusApproval', 'history')
            ->where([
                'id' => $id,
                'approval' => 301,
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
            $request->validate([
                'jenis_saving' => 'required',
            ]);
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

            if (intval($data->costSaving) > 30000000) {
                # code...
                $data->update([
                    'category_id' => $request->jenis_saving,
                    'approval' => 500
                ]);

                HistoryOneSheetReport::create([
                    'user_id' => auth()->user()->id,
                    'one_sheet_report_id' => $data->id,
                    'status' => 500
                ]);

                event(new NotificationEvent(
                    $data->user_id,
                    'Success Approval MSTD SPV',
                    'One Sheet Report telah disetujui oleh MSTD SPV ' . auth()->user()->fullname,
                    route('v1.osr.index')
                ));

                event(new NotificationEvent(
                    $data->user_id,
                    'Finished Approval',
                    'One Sheet Report telah Selesai dan silahkan cek kembali',
                    route('v1.osr.index')
                ));

                $message = 'Halo, Persetujuan anda sudah selesai untuk One Sheet Report, Silahkan Cek Terlebih dahulu';
                $email = [
                    'status' => 'Waiting Approval Finance Accounting',
                    'link' => route('v1.financeAccounting.osr.index'),
                    'penerima' => $data->pemohon->fullname,
                    'body' => $message
                ];
                (new ApprovalMailService)->handle($data->pemohon->email, $email);

            } else {
                # code...
                $data->update([
                    'category_id' => $request->jenis_saving,
                    'approval' => 401
                ]);

                HistoryOneSheetReport::create([
                    'user_id' => auth()->user()->id,
                    'one_sheet_report_id' => $data->id,
                    'status' => 401
                ]);

                event(new NotificationEvent(
                    $data->user_id,
                    'Success Approval MSTD SPV',
                    'One Sheet Report telah disetujui oleh MSTD SPV ' . auth()->user()->fullname,
                    route('v1.osr.index')
                ));
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Approval',
                'redirect' => route('v1.mstdSpv.osr.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error approval OSR : ' . $th->getMessage());

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
                'approval' => 302
            ]);

            HistoryOneSheetReport::create([
                'user_id' => auth()->user()->id,
                'one_sheet_report_id' => $data->id,
                'status' => 302,
                'note' => $request->note
            ]);

            // Buat NOtifikasi Ke USers
            event(new NotificationEvent(
                $data->user_id,
                'Success Return MSTD SPV',
                'One Sheet Report telah return oleh MSTD SPV ' . auth()->user()->fullname,
                route('v1.osr.index')
            ));

            $message = 'Halo, Persetujuan anda One Sheet Report telah dikembalikan dengan catatan : ' . $request->note . ' , Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Return By MSTD SPV',
                'link' => route('v1.osr.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new RejectApproval($email));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Return',
                'redirect' => route('v1.mstdSpv.osr.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error return OSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
