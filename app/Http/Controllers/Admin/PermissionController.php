<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System\Permission;
use App\Models\System\Role;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        // // Kosongkan tabel permissions
        // Permission::truncate();

        // // Dapatkan semua rute yang memiliki nama
        // $routes = Route::getRoutes()->getRoutesByName();
        // $role = Role::latest()->get();

        // foreach ($role as $item) {
        //     # code...
        //     foreach ($routes as $routeName => $route) {
        //         // Simpan routeName dan URL ke tabel permissions
        //         Permission::create([
        //             'url' => $routeName, // Menggunakan nama rute sebagai identifikasi
        //             'role_id' => $item->id // Set default jobLvl, ini dapat diubah sesuai kebutuhan Anda
        //         ]);
        //     }
        // }
        // dd($request->user());
        $role = Role::all();
        return view('admin.permission.index', compact('role'));
    }

    public function hrisGetEmployee()
    {
        $text = 'https://api-pharma.kalbe.co.id/v1/ListJobLvlName';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-API-Key' => 'SQA45CsPgqRCeyoO0ZzeKK6BFG1vpR1vy7r-gvPiEw4',
        ])->get($text);
        $response = $response->json();

        foreach ($response as $key => $value) {
            # code...
            Role::create([
                'name' => $value
            ]);
        }
    }

    public function create()
    {
        // Ambil semua rute dari aplikasi
        $routes = Route::getRoutes()->getRoutesByName();
        return view('admin.permission.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'urls' => 'required|array',
            'jobLvl' => 'required|string',
        ]);

        Permission::create([
            'urls' => $request->input('urls'), // Menyimpan array URL
            'jobLvl' => $request->input('jobLvl'),
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $role = Role::with('permission')->find($id);

        $routes = Route::getRoutes()->getRoutesByName();
        return view('admin.permission.edit', compact('role', 'routes'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        try {
            DB::beginTransaction();
            // Hapus permissions lama jika ada
            $role->permission()->delete();

            // Perbarui izin berdasarkan URL yang dipilih
            foreach ($request->input('urls', []) as $url) {
                $role->permission()->create(['url' => $url]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return response()->json([
            'success' => true,
            'message' => 'Success Update',
            'redirect' => route('admin.permission.index')
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
