<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_pelanggan' => 'PL'.spintf('%08d',fake()->unique()->numberBeetween(1,00000000)),
            'nama' => fake ()-> name($gender =null|'male'|'female'),
            'alamat' => fake()->address(),
            'no_telp' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
