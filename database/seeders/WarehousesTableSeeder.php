<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehousesTableSeeder extends Seeder
{
    public function run()
    {
        Warehouse::factory()->count(10)->create();
    }
}

