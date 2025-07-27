<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Projet;
use App\Models\Issue;
use App\Models\Improvement;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $team = Team::create(['name' => 'Équipe Admin']);
        $admin->team()->associate($team);
        $admin->save();

        for ($i = 1; $i <= 5; $i++) {
            $projet = Projet::create([
                'name' => "Projet Admin $i",
                'description' => "Description du projet $i",
                'date_assignation' => now(),
                'avancement' => rand(0, 100),
                'priority' => rand(1, 3),
                'team_id' => $team->id,
            ]);

            $projet->users()->attach($admin->id);

            foreach (range(1, 10) as $j) {
                $state = $j % 2 === 0 ? 'Ouvert' : 'Fermé';
                $issue = Issue::create([
                    'titre' => "Problème $j",
                    'description' => "Détail du problème $j",
                    'priority' => rand(1, 3),
                    'state' => $state,
                    'creator_id' => $admin->id,
                    'projet_id' => $projet->id,
                ]);

                foreach (range(1, 3) as $k) {
                    Comment::create([
                        'content' => "Commentaire $k sur le problème $j",
                        'user_id' => $admin->id,
                        'commentable_type' => Issue::class,
                        'commentable_id' => $issue->id,
                    ]);
                }
            }

            foreach (range(1, 10) as $j) {
                $states = ['En attente', 'Accepté', 'Refusé'];
                $state = $states[$j % 3];
                $improvement = Improvement::create([
                    'titre' => "Amélioration $j",
                    'description' => "Détail de l'amélioration $j",
                    'state' => $state,
                    'creator_id' => $admin->id,
                    'projet_id' => $projet->id,
                ]);

                foreach (range(1, 3) as $k) {
                    Comment::create([
                        'content' => "Commentaire $k sur l'amélioration $j",
                        'user_id' => $admin->id,
                        'commentable_type' => Improvement::class,
                        'commentable_id' => $improvement->id,
                    ]);
                }
            }

            foreach (range(1, 3) as $k) {
                Comment::create([
                    'content' => "Commentaire $k sur le projet $i",
                    'user_id' => $admin->id,
                    'commentable_type' => Projet::class,
                    'commentable_id' => $projet->id,
                ]);
            }
        }
    }
}
