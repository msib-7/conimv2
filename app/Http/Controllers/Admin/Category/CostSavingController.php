<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\System\CategorySaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Yajra\DataTables\DataTables;

class CostSavingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CategorySaving::query()->orderBy('title', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn_1 = '<a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('admin.category.costSaving.show', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-info editPost"><i class="ti ti-edit f-20"></i></a>';
                    $btn = $btn_1 . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('admin.category.costSaving.destroy', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.ss.index');
    }

    public function show($id)
    {
        $product = CategorySaving::find($id);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $data = CategorySaving::find($id);
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Category Tidak Tersedia'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category Berhasil dihapus'
        ]);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file'
        ]);

        (new FastExcel())->import($request->berkas, function ($line) {
            return CategorySaving::create([
                'user_id' => auth()->user()->id,
                'title' => $line['TITLE'],
                'deskripsi' => $line['DESC']
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Import Excell Success',
            'redirect' => route('admin.category.costSaving.index')
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
        ], [
            'title.required' => 'Masukan Nama Category',
            'desc.required' => 'Masukan Deskripsi Category'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->all()
            ]);
        }

        try {
            DB::beginTransaction();

            CategorySaving::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'user_id' => auth()->user()->id,
                    'title' => $request->title,
                    'deskripsi' => $request->desc,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Category Success Added'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th
            ]);
        }
    }
}
