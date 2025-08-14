<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogProses>
 */
class LogProsesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'petugas' => $this->faker->name(),
            'aksi' => $this->faker->randomElement(['Tambah Data', 'Ubah Data', 'Hapus Data']),
            'tindakan' => $this->faker->sentence(6)
        ];
    }
}
