<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Officer;
use App\Models\Patient;
use App\Models\Scheduler;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create(
            [
                'email' => 'admin1@pka.com',
                'password' => 'phenikaa'
            ]
        )
        ->assignRole('admin');

        Officer::factory()->withEmail('officer1@pka.com')->create();
        Scheduler::factory()->withEmail('scheduler1@pka.com')->create();
        Doctor::factory()->withEmail('doctor1@pka.com')->create();
        Patient::factory()->withEmail('patient1@pka.com')->create();
    }
}
