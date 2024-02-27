<?php

namespace Database\Seeders;

use App\Models\Acquisition;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcquisitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Acquisition::factory(10)->create();
    }
}
