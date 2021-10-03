<?php

namespace App\Services;

use App\Models\Match;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Support\Collection;

class MatchService
{
    private WeekService $weekService;

    public function __construct(WeekService $weekService)
    {
        $this->weekService = $weekService;
    }

    public function generate(Collection $teams): Collection
    {
        $weeks = $this->weekService->all();
        $teamsId = $teams->pluck('id');
        $coll = collect($teamsId);
        $matrix = $coll->crossJoin($teamsId);

        $matches = $matrix->reject(function ($items) {
            if ($items[0] == $items[1]) {
                return $items;
            }
        })->shuffle();

        foreach ($weeks as $week) {
            $counter = 0;
            foreach ($matches as $key => $match) {
                if ($this->checkIfMatchCanBeCreated($match, $week->id)) {
                    Match::create([
                        'home_team_id' => $match[0],
                        'away_team_id' => $match[1],
                        'week_id' => $week->id,
                    ]);

                    unset($matches[$key]);

                    $counter++;

                    if ($counter == 2) {
                        break;
                    }
                }
            }
        }

        return $this->weekService->allWithFixtures();
    }

    public function checkIfMatchCanBeCreated(array $teams, int $weekId): bool
    {
        return (!Match::where('week_id', $weekId)
            ->where(function ($q) use ($teams) {
                $q->whereIn('home_team_id', $teams)
                    ->orWhereIn('away_team_id', $teams);
            })
            ->exists());
    }

    public function getMatchesOfWeek(int $week)
    {
        return Match::with('homeTeam', 'awayTeam')
            ->where('week_id', $week)
            ->get();
    }

    public function playMatchesOfWeek(int $week): Collection
    {
        $matches = Match::where('week_id', $week)
            ->with('homeTeam', 'awayTeam')
            ->get();


        $matches->where('played', 0)->each(function ($match) {
            $homeScore = $this->calculateScore($match->homeTeam, true);
            $awayScore = $this->calculateScore($match->awayTeam);

            $match->home_goals = $homeScore;
            $match->away_goals = $awayScore;
            $match->played = 1;
            $match->save();

            $this->updateStandings($match);
        });

        return $matches;
    }

    public function calculateScore(Team $team, bool $isHome = false): int
    {
        $strength = $team->strength;

        if ($isHome) {
            $strength = $strength + ($strength * 20 / 100);
        }

        if ($strength <= 30) {
            $score = rand(0, 3);
        } else if ($strength <= 60) {
            $score = rand(2, 4);
        } else {
            $score = rand(3, 6);
        }

        return $score;
    }

    public function updateStandings(Match $match)
    {
        $homeTeamStanding = $match->homeStanding;
        $awayTeamStanding = $match->awayStanding;

        if ($match->home_goals > $match->away_goals) {
            $homeTeamStanding->won += 1;
            $homeTeamStanding->points += 3;
            $homeTeamStanding->goal_drawn += ($match->home_goals - $match->away_goals);
            $awayTeamStanding->lose += 1;
            $awayTeamStanding->goal_drawn += ($match->away_goals - $match->home_goals);
        } else if ($match->home_goals < $match->away_goals) {
            $awayTeamStanding->won += 1;
            $awayTeamStanding->points += 3;
            $awayTeamStanding->goal_drawn += ($match->away_goals - $match->home_goals);
            $homeTeamStanding->lose += 1;
            $homeTeamStanding->goal_drawn += ($match->home_goals - $match->away_goals);
        } else {
            $homeTeamStanding->draw += 1;
            $homeTeamStanding->points += 1;
            $awayTeamStanding->draw += 1;
            $awayTeamStanding->points += 1;
        }

        $homeTeamStanding->times_played += 1;
        $awayTeamStanding->times_played += 1;

        $homeTeamStanding->save();
        $awayTeamStanding->save();
    }

    public function didPlayAll(): bool
    {
        $countOfMatches = Match::count();
        $countOfPlayedMatches = Match::where('played', 1)->count();

        return $countOfMatches === $countOfPlayedMatches && ($countOfMatches > 0);
    }

    public function reset()
    {
        Match::truncate();
        Standing::where('times_played', '>', 0)->update([
            'points' => 0,
            'times_played' => 0,
            'won' => 0,
            'lose' => 0,
            'draw' => 0,
            'goal_drawn' => 0,
        ]);
    }

    public function getAllLeft()
    {
        return Match::with('homeTeam', 'awayTeam')
            ->where('played', 0)
            ->get();
    }
}
