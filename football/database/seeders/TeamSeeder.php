<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'Liverpool',
                'logo' => 'assets/logos/liverpool.png',
                'strength' => 40,
            ],
            [
                'name' => 'Manchester United',
                'logo' => 'assets/logos/manchester_united.png',
                'strength' => 25,
            ],
            [
                'name' => 'Chelsea',
                'logo' => 'assets/logos/chelsea.png',
                'strength' => 65,
            ],
            [
                'name' => 'Arsenal',
                'logo' => 'assets/logos/arsenal.png',
                'strength' => 86,
            ],
        ];

        foreach($teams as $team) {
            $team = Team::create($team);
            $team->standing()->create();
        }
    }
}
