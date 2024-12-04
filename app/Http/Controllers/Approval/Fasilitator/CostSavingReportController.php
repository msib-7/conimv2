<?php

namespace App\Http\Controllers\Approval\Fasilitator;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\RejectApproval;
use App\Models\System\CategoryCorporate;
use App\Models\System\CategoryImpactTo;
use App\Models\System\CategorySavingSpv;
use App\Models\System\CostSavingReport;
use App\Models\System\HistoryCostSavingReport;
use App\Models\System\UserMstdOfficer;
use App\Services\System\ApprovalMailService;
use App\Services\System\GetFasilitatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class CostSavingReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CostSavingReport::query()
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
                    $btn = '<a href="' . route('v1.approval.fasilitator.csr.show', $row->id) . '" class="btn btn-success"><i class="ti ti-eye f-20"></i> Show More</a>';
                    return $btn;
                })
                ->addColumn('approvalnya', function ($row) {
                    return $row->statusApproval->description;
                })

                ->rawColumns(['action', 'approvalnya'])
                ->make(true);
        }

        return view('v1.csr.fasilitator.index');
    }

    public function show($id)
    {
        $data = CostSavingReport::query()
            ->with('statusApproval', 'history', 'pemohon')
            ->where([
                'id' => $id,
                'approval' => 101,
                'status' => 'publish'
            ])->first();

        if (empty($data)) {
            # code...
            return redirect()->route('v1.approval.fasilitator.csr.index')->with('galat', 'Cost Saving Report Tidak Tersedia');
        }

        // Improvment
        $cat_improvment = CategorySavingSpv::latest()->get();
        $cat_corp = CategoryCorporate::latest()->get();
        $cat_impact = CategoryImpactTo::latest()->get();

        return view('v1.csr.fasilitator.show', compact('data', 'cat_improvment', 'cat_impact', 'cat_corp'));
    }

    public function store(Request $request, $id)
    {
        $data = CostSavingReport::query()
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

        if ($request->status == "approve") {
            # code...
            $request->validate([
                'cat_improvment' => 'required',
                'cat_corp' => 'required',
                'cat_impact' => 'required',
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

            $data->update([
                'category_improvment_id' => $request->cat_improvment,
                'category_corporate_id' => $request->cat_corp,
                'category_impact_id' => $request->cat_impact,
                'nomorCC' => $request->nomorCC,
                'approval' => 201
            ]);

            HistoryCostSavingReport::create([
                'user_id' => auth()->user()->id,
                'cost_saving_report_id' => $data->id,
                'status' => 201
            ]);

            event(new NotificationEvent(
                $data->user_id,
                'Success Approval Fasilitator',
                'Cost Saving Report telah disetujui oleh Fasilitator ' . auth()->user()->fullname,
                route('v1.csr.index')
            ));

            $message = 'Halo anda baru saja menerima permintaan persetujuan Cost Saving Report yang telah dibuat oleh ' . $data->pemohon->fullname . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Waiting Approval MSTD Officer',
                'link' => route('v1.mstdOfficer.csr.index'),
                'penerima' => 'MSTD Officer',
                'body' => $message
            ];
            $mstdOfficer = UserMstdOfficer::pluck('email');
            (new ApprovalMailService)->handle($mstdOfficer, $data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Approval',
                'redirect' => route('v1.approval.fasilitator.csr.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error approval CSR : ' . $th->getMessage());

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
                'approval' => 102
            ]);

            HistoryCostSavingReport::create([
                'user_id' => auth()->user()->id,
                'cost_saving_report_id' => $data->id,
                'status' => 102,
                'note' => $request->note
            ]);

            // Buat NOtifikasi Ke USers
            event(new NotificationEvent(
                $data->user_id,
                'Success Return Fasilitator',
                'Cost Saving Report telah return oleh Fasilitator ' . auth()->user()->fullname,
                route('v1.csr.index')
            ));

            $message = 'Halo, Persetujuan anda Cost Saving Report telah dikembalikan dengan catatan : ' . $request->note . ' , Silahkan Cek Terlebih dahulu';
            $email = [
                'status' => 'Return By Fasilitator',
                'link' => route('v1.csr.index'),
                'penerima' => $data->pemohon->fullname,
                'body' => $message
            ];
            Mail::to($data->pemohon->email)->send(new RejectApproval($email));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Success Return',
                'redirect' => route('v1.approval.fasilitator.csr.index')
            ]);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error return CSR : ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Submit, Try Again',
                'data' => $th
            ]);
        }
    }
}
