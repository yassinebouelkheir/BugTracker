<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetFactory extends Factory
{
    protected $model = \App\Models\Projet::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date_assignation' => $this->faker->date(),
            'avancement' => $this->faker->randomElement(['non commencé', 'en cours', 'terminé']),
            'priority' => $this->faker->numberBetween(1, 3),
            'team_id' => null, // assign in seeder if needed
        ];
    }
}
