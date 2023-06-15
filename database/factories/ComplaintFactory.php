<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\Organization;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'organization_id' => Organization::factory(),
            'school_id' => School::factory(),
            'description' => $this->faker->paragraph,
            'classification' => $this->faker->randomElement(['azul', 'verde', 'amarelo', 'laranja', 'vermelho']),
            'status' => $this->faker->randomElement(['postado', 'validado', 'notificado']),
        ];
    }
}
