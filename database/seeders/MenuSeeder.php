<?php

namespace Database\Seeders;

use App\Models\System\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menu utama: Manage Suggestion System
        $manageSuggestionSystem = Menu::create([
            'label' => 'Manage Suggestion System',
            'route' => null, // Tidak memiliki tautan
            'icon' => 'ti ti-dashboard',
            'parent_id' => null,
            'order' => 1,
            'jobLvl' => null, // Kosong karena ini hanya judul
        ]);

        // Sub-menu: List SS
        Menu::create([
            'label' => 'List SS',
            'route' => 'v1.ss.index',
            'icon' => 'custom-document-filter',
            'parent_id' => $manageSuggestionSystem->id,
            'order' => 1,
            'jobLvl' => json_encode(['Administrator', 'Manager']), // Hanya untuk Admin dan Manager
        ]);

        // Sub-menu: Approval SS
        Menu::create([
            'label' => 'Approval SS',
            'route' => 'v1.approval.fasilitator.suggestion_System.index',
            'icon' => 'custom-security-safe',
            'parent_id' => $manageSuggestionSystem->id,
            'order' => 2,
            'jobLvl' => json_encode(['Manager', 'SUPERVISOR']), // Hanya untuk Manager dan Supervisor
        ]);
    }
}
