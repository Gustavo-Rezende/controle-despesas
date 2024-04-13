<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cartao' => function () {
                return \App\Models\Cartao::factory()->create()->id;
            },
            'valor' => $this->faker->randomFloat(2, 0, 10000),
            'categoria' => $this->faker->randomElement(['alimentacao', 'combustivel', 'transporte']),
        ];
    }
}
