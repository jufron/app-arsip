<?php

namespace Database\Factories;

use App\Models\Arsip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileArsip>
 */
class FileArsipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dokumentArsipIds = Arsip::pluck('id')->toArray();

        return [
            'dokument_arsip_id' => $this->faker->randomElement($dokumentArsipIds),
            'nama_file' => $this->faker->word . '.' . $this->faker->fileExtension,
        ];
    }
}
