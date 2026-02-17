<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'documento' => $this->faker->unique()->numerify('##########'),
            'numero_seguro' => $this->faker->unique()->numerify('##########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'telefono' => $this->faker->numerify('##########'),
            'correo' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            'grupo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'alergias' => $this->faker->sentence(),
            'contacto_emergencia' => $this->faker->name() . ' - ' . $this->faker->numerify('##########'),
            'observaciones' => $this->faker->paragraph(),
        ];
    }
}
