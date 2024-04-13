<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cartao>
 */
class CartaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $numero_cartao = '****-****-****-' . substr(str_shuffle('0123456789'), 0, 4);
         return [
             'id_user' => function () {
                 return \App\Models\User::factory()->create()->id;
             },
             'saldo' => $this->faker->randomFloat(2, 0, 10000),
             'numero_cartao' => $numero_cartao,
         ];
    }
}
