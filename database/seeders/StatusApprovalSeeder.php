<?php

namespace Database\Seeders;

use App\Models\System\StatusApproval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['code' => 100, 'description' => 'Saved Drafted'],
            ['code' => 101, 'description' => 'Waiting Fasilitator'],
            ['code' => 102, 'description' => 'Return By Fasilitator'],
            ['code' => 201, 'description' => 'Waiting MSTD Staff'],
            ['code' => 202, 'description' => 'Return By MSTD Staff'],
            ['code' => 301, 'description' => 'Waiting MSTD SPV'],
            ['code' => 302, 'description' => 'Return By MSTD SPV'],
            ['code' => 401, 'description' => 'Waiting FA'],
            ['code' => 402, 'description' => 'Return By FA'],
            ['code' => 500, 'description' => 'Finish Approval'],
        ];

        foreach ($statuses as $status) {
            StatusApproval::create($status);
        }
    }
}
