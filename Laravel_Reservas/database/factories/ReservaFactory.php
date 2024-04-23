<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Tipo;
use App\Models\SalaZoom;

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
            //
            'user_id' => User::factory(),
            'tipo_id' => Tipo::factory(),
            'sala_zoom_id' => SalaZoom::factory(),
            'fecha' => $this->faker->dateTime(),
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(2),
            'codigo_sipro'=> $this->faker->randomLetter(),
        ];
    }
}
