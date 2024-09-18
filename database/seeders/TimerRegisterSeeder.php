<?php

namespace Database\Seeders;

use App\Models\TimerRegister;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimerRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimerRegister::factory()->count(10)->create();
    }
}
