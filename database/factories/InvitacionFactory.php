<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invitacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitacion>
 */
class InvitacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'confirmacion' => $this->faker->boolean(False),
            'protegido' => $this->faker->boolean(False),
            'Keyinvited' => $this->faker->text(16),
        ];
    }
}
