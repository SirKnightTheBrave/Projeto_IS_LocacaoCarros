<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bem_locavel_id' => $this->faker->numberBetween(1, 100), // Supondo que você tenha 100 bens locáveis
            'user_id' => $this->faker->numberBetween(1, 50), // Supondo que você tenha 50 usuários
            'data_inicio' => $this->faker->dateTimeBetween('now', '+1 month'),
            'data_fim' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'preco_total' => $this->faker->randomFloat(2, 10, 500), // Preço entre 10 e 500
            'status' => $this->faker->randomElement(['reservado', 'cancelado', 'concluido']),
        ];
    }
}
