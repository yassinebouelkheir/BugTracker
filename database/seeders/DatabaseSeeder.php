<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Projet;
use App\Models\Issue;
use App\Models\Improvement;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $teams = Team::factory()->count(3)->create();

        User::factory()->count(20)->create()->each(function ($user) use ($teams) {
            $team = $teams->random();
            $user->team()->associate($team);
            $user->save();
        });

        Projet::factory()->count(5)->create()->each(function ($projet) use ($teams) {
            if (rand(0,1)) {
                $projet->team_id = $teams->random()->id;
                $projet->save();
            } else {
                $users = User::inRandomOrder()->take(rand(1,3))->get();
                $projet->save();
                $projet->users()->attach($users->pluck('id')->toArray());
            }
        });

        Issue::factory()->count(10)->create();

        Improvement::factory()->count(10)->create();

        Comment::factory()->count(15)->create();
    }
}
