<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Pemohon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemohon>
 */
class PemohonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemohon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $userId = $this->faker->randomElement($userIds);

        $randomDate = $this->faker->dateTimeBetween('-2 years', 'now');

        return [
            'nik'               => $this->faker->unique()->numerify('##########'),
            'nama'              => $this->faker->name(),
            'jenis_pengurusan'  => $this->faker->randomElement(['KTP baru', 'Rusak', "Hilang", "Lainya"]),
            'tanggal_pengurusan'=> $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id'           => $userId,
            'created_at'        => $randomDate,
            'updated_at'        => $randomDate
        ];
    }
}
