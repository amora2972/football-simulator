<?php

namespace App\Services;

use App\Models\Standing;

class StandingService
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function all()
    {
        return Standing::with('team')->get();
    }

    public function predictAllLeftMatches(): array
    {
        $standings = $this->all();
        $leftMatches = $this->matchService->getAllLeft();

        $allTeams = $standings
            ->pluck('points', 'team_id')
            ->toArray();

        $leftMatches->each(function ($match) use (&$allTeams, $standings) {
            $homeTeamScore = $this->matchService->calculateScore($match->homeTeam, true);
            $awayTeamScore = $this->matchService->calculateScore($match->awayTeam);

            if ($homeTeamScore > $awayTeamScore) {
                $allTeams[$match->homeTeam->id] += 3;
            } else if ($homeTeamScore < $awayTeamScore) {
                $allTeams[$match->awayTeam->id] += 3;
            } else {
                $allTeams[$match->homeTeam->id] += 1;
                $allTeams[$match->awayTeam->id] += 1;
            }
        });

        $percentage = [];
        foreach ($allTeams as $teamId => $points) {
            $percentage[] = [
                'team_id' => $teamId,
                'winning_percentage' => round($points / array_sum($allTeams) * 100, 2)
            ];
        }

        return $percentage;
    }
}
