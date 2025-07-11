<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'          => '@dodi',
            'email'         => 'dodi@gmail.com',
            'nama_petugas'  => 'Dodi',
            'password'      => bcrypt('12345678'),
        ]);

        User::create([
            'name'          => '@esra',
            'email'         => 'esra@mail.com',
            'nama_petugas'  => 'Esra',
            'password'      => bcrypt('5301225707010003'),
        ]);
    }
}
