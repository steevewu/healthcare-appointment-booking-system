<?php

namespace Database\Seeders;

use App\Models\Workshift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkshiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Workshift::factory()->count(333)->create();
    }
}
