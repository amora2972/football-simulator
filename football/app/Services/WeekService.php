<?php

namespace App\Services;

use App\Models\Week;
use Illuminate\Support\Collection;

class WeekService
{
    public function allWithFixtures(): Collection
    {
        return Week::with('matches')->get();
    }

    public function generateWeeks(Collection $teams)
    {
        $numberOfWeeks = ($teams->count() - 1) * 2;

        for ($i = 0; $i < $numberOfWeeks; $i++) {
            Week::create([
                'name' => 'week ' . ($i + 1),
            ]);
        }
    }

    public function all(): Collection
    {
        return Week::with('matches.homeTeam', 'matches.awayTeam')->get();
    }
}
