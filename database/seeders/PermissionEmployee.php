<?php

namespace Database\Seeders;

use App\Models\System\Permission;
use App\Models\System\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionEmployee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes()->getRoutesByName();
        $role = Role::latest()->get();

        foreach ($role as $item) {
            foreach ($routes as $routeName => $route) {
                // Cek apakah route memiliki prefix "v1"
                if (str_starts_with($route->getPrefix(), 'v1')) {
                    // Simpan routeName dan URL ke tabel permissions
                    Permission::create([
                        'url' => $routeName, // Menggunakan nama rute sebagai identifikasi
                        'role_id' => $item->id // Set default jobLvl, ini dapat diubah sesuai kebutuhan Anda
                    ]);
                }
            }
        }
    }
}
