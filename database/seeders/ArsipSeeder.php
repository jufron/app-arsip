<?php

namespace Database\Seeders;

use App\Models\Arsip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arsip::factory()->count(10)->createQuietly();
    }
}
