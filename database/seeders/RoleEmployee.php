<?php

namespace Database\Seeders;

use App\Models\System\Permission;
use App\Models\System\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class RoleEmployee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
}
