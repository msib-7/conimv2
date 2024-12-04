<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System\Menu;
use App\Models\System\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::latest()->get();
        if ($request->ajax()) {
            $data = $menus;
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('admin.menu.destroy', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        $routes = Route::getRoutes()->getRoutesByName();
        $roles = Role::latest()->get();
        return view('admin.menu.index', compact('menus', 'routes', 'roles'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'required|integer',
        ]);

        Menu::create([
            'label' => $request->title,
            'route' => $request->link,
            'icon' => $request->icon,
            'parent_id' => $request->parent,
            'order' => $request->order,
            'jobLvl' => json_encode($request->role)  // Menambahkan jobLvl jika ada
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Success Submit',
            'redirect' => route('admin.menu.index')
        ]);
    }

    // Menampilkan form untuk mengedit menu
    public function edit(Menu $menu)
    {
        $menus = Menu::all(); // Ambil semua menu sebagai pilihan parent menu
        return view('menus.edit', compact('menu', 'menus'));
    }

    // Memperbarui data menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'required|integer',
        ]);

        $menu->update([
            'label' => $request->label,
            'route' => $request->route,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'jobLvl' => $request->jobLvl ?? null,  // Memperbarui jobLvl jika ada
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Success Update',
            'redirect' => route('admin.menu.index')
        ]);
    }

    // Menghapus menu
    public function destroy($id)
    {
        $data = Menu::find($id);
        // Pastikan menu tidak memiliki submenu
        if (!empty($data->children)) {
            return response()->json([
                'success' => false,
                'message' => 'ini merupakan judul menu, hapus dahulu sub menunya'
            ]);
        } else {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'menu has been deleted'
            ]);
        }
    }
}
