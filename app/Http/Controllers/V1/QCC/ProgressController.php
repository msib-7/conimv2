<?php

namespace App\Http\Controllers\V1\QCC;

use App\Http\Controllers\Controller;
use App\Models\System\ProgressQualityCircleControl;
use App\Models\System\QualityCircleControl;
use Fauzantaqiyuddin\LaravelMinio\Facades\Miniojan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProgressController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = QualityCircleControl::with('teams')->find($id);

        if ($request->ajax()) {
            $progress = ProgressQualityCircleControl::query()
                ->with('statusApproval')
                ->where('quality_circle_control_id', $data->id)
                ->get();

            return DataTables::of($progress)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    // Sesuaikan id quality_circle_control dengan id progress dari $row
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-url="' . route('v1.qcc.progress.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-sm btn-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                    return $btn;
                })
                ->addColumn('approvalnya', function ($row) {
                    // Pastikan $row memiliki relasi 'statusApproval' sebelum mengakses deskripsinya
                    return $row->statusApproval ? $row->statusApproval->description : '-';
                })
                ->addColumn('absennya', function ($row) {
                    // Pastikan $row memiliki relasi 'statusApproval' sebelum mengakses deskripsinya
                    return $row->progress . '%';
                })

                ->rawColumns(['action', 'approvalnya', 'absennya'])
                ->make(true);
        }

        if ($data->approval > 201) {
            # code...
            return back()->with('galat', 'Silahkan approve fasilitator sebelum melakukan progress');
        }

        $absensi = $data->teams;

        return view('v1.qcc.operator.progress.index', compact('data', 'absensi'));
    }

    private function uploadToMinio($image)
    {
        $file = $image;
        $directory = 'conim/qcc/';

        $path = $file->store('temp');
        $filePath = storage_path('app/' . $path);

        // Upload file ke MinIO
        $response = Miniojan::upload($directory, $filePath);
        unlink($filePath);
        return $response;
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'langkah' => 'required',
            'notulensi' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            // 'absensi' => 'required|array',
            'lampiran' => [
                'required_unless:langkah,Langkah 8 - Standardisasi & Tindak lanjut',
                'file',
                'mimes:pdf',
                'max:3072' // max file size in kilobytes (3 MB)
            ]
        ]);

        // Pisahkan langkah menjadi dua bagian berdasarkan tanda " - "
        list($step, $deskripsi) = explode(' - ', $request->langkah, 2);
        $step = (int) filter_var($step, FILTER_SANITIZE_NUMBER_INT); // Konversi 'Langkah x' ke nomor integer

        // Ambil langkah sebelumnya dari database
        $previousStep = ProgressQualityCircleControl::where('quality_circle_control_id', $id)
            ->orderBy('step', 'desc') // Mengambil langkah terakhir
            ->first();

        // Data QCC
        $qcc = QualityCircleControl::with('teams')->find($id);

        // Jika ada langkah sebelumnya, casting langkah sebelumnya menjadi integer
        if ($previousStep) {
            $previousStepNumber = (int) filter_var($previousStep->step, FILTER_SANITIZE_NUMBER_INT);

            // Cek apakah langkah saat ini urut (harus +1 dari langkah sebelumnya)
            if (($step - $previousStepNumber) != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Langkah tidak boleh loncat. Harus mengikuti urutan.',
                ]);
            }

            // Cek apakah approval langkah sebelumnya adalah 500
            if ($previousStep->approval != 500) {
                return response()->json([
                    'success' => false,
                    'message' => 'Langkah sebelumnya belum mendapatkan approval Fasilitator',
                ]);
            }
        }

        // Abensi
        $totalTim = count($qcc->teams);
        $absen_before = (($totalTim - count($request->absensi)) / $totalTim) * 100;

        // Jika semua validasi lolos, lanjutkan penyimpanan
        ProgressQualityCircleControl::create([
            'user_id' => auth()->user()->id,
            'lampiran' => $this->uploadToMinio($request->lampiran),
            'quality_circle_control_id' => $id,
            'step' => $step, // Nomor langkah yang valid
            'deskripsi' => trim($deskripsi), // Bagian sesudah " - ", deskripsi
            'notulensi' => $request->notulensi,
            'approval' => 101,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'absensi' => json_encode($request->absensi),
            'progress' => 100 - $absen_before
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Import Excell Success',
            'redirect' => route('v1.qcc.progress.index', $id)
        ]);
    }

    public function destroy($id)
    {
        $data = ProgressQualityCircleControl::find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Progress QCC Tidak Ada'
            ]);
        }

        if ($data->approval == 500) {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Progress QCC Tidak Bisa dihapus Karena Sudah Publish'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Progress QCC Berhasil dihapus'
        ]);
    }
}
