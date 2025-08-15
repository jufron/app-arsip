<?php

namespace Database\Factories;

use App\Models\Pemohon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arsip>
 */
class ArsipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dokumen_pemohon_id = Pemohon::pluck('id')->toArray();
        $lemari = ['Lemari 1', 'Lemari 2', 'Lemari 3', 'Lemari 4', 'Lemari 5'];
        $rak = ['Rak 1', 'Rak 2', 'Rak 3', 'Rak 4', 'Rak 5'];
        $laci = ['Laci 1', 'Laci 2', 'Laci 3', 'Laci 4', 'Laci 5'];
        $box = ['Box 1', 'Box 2', 'Box 3', 'Box 4', 'Box 5'];
        $ruangan = ['Ruangan 1', 'Ruangan 2', 'Ruangan 3', 'Ruangan 4', 'Ruangan 5'];

        $randomDate = $this->faker->dateTimeBetween('-2 years', 'now');

        return [
            'dokumen_pemohon_id'        => $this->faker->randomElement($dokumen_pemohon_id),
            'ruangan'                   => $this->faker->randomElement($ruangan),
            'lemari'                    => $this->faker->randomElement($lemari),
            'rak'                       => $this->faker->randomElement($rak),
            'laci'                      => $this->faker->randomElement($laci),
            'box'                       => $this->faker->randomElement($box),
            'keterangan'                => $this->faker->sentence,
            'tanggal_arsip'             => $this->faker->date(),
            'created_at'                => $randomDate,
            'updated_at'                => $randomDate
        ];
    }
}
