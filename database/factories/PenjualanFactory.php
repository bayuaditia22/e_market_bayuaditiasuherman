<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Pelanggan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penjualan>
 */
class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
    return [
           'no_faktur' => "P" .sprintf('%08d', fake()->unique()->numberBetween(1,99999999)),
           'tgl_faktur' =>'2022-'.fake()->numberBetween(1,12)."-".fake()->numberBetween(1,30),
           'total_bayar' => fake()->numberBetween(1000,100000),
           'pelanggan_id' => fake()->randomElement(Pelanggan::select('id')->get()),
           'user_id' => 1
           
        ];
    }
}
