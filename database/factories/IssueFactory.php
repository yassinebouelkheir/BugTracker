<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    protected $model = \App\Models\Issue::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'priority' => $this->faker->numberBetween(1, 3),
            'state' => $this->faker->randomElement(['open', 'in progress', 'closed']),
            'creator_id' => \App\Models\User::factory(),
        ];
    }
}
