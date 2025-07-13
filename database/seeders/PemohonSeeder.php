<?php

namespace Database\Seeders;

use App\Models\Pemohon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemohonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemohon::factory()->count(20)->create();
    }
}
