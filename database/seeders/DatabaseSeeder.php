<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer 2 Équipes
        $teamA = Team::create(['name' => 'Équipe Alpha']);
        $teamB = Team::create(['name' => 'Équipe Bêta']);

        // 2. Administrateur
        User::create([
            'name' => 'Admin VisionBF',
            'email' => 'admin@visionbf.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Secrétaire
        User::create([
            'name' => 'Secrétaire VISIONBF',
            'email' => 'secretaire@visionbf.com',
            'password' => Hash::make('password'),
            'role' => 'secretary',
        ]);

        // 4. Superviseur Équipe Alpha
        User::create([
            'name' => 'Superviseur Alpha',
            'email' => 'superviseur.a@visionbf.com',
            'password' => Hash::make('password'),
            'role' => 'supervisor',
            'team_id' => $teamA->id,
        ]);

        // 5. Agent Équipe Alpha
        User::create([
            'name' => 'Agent Alpha 1',
            'email' => 'agent1.a@visionbf.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'team_id' => $teamA->id,
        ]);
    }
}