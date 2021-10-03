<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseBuilder;
use App\Models\Week;
use App\Services\MatchService;
use App\Services\TeamService;
use Illuminate\Http\JsonResponse;

class MatchController extends Controller
{
    private MatchService $matchService;
    private TeamService $teamService;

    public function __construct(MatchService $matchService, TeamService $teamService)
    {
        $this->matchService = $matchService;
        $this->teamService = $teamService;
    }

    public function generate(): JsonResponse
    {
        $fixtures = $this->matchService->generate($this->teamService->all());
        return ResponseBuilder::success($fixtures);
    }

    public function week(Week $week): JsonResponse
    {
        $fixture = $this->matchService->getMatchesOfWeek($week->id);
        return ResponseBuilder::success($fixture);
    }

    public function play(Week $week): JsonResponse
    {
        $matches = $this->matchService->playMatchesOfWeek($week->id);
        return ResponseBuilder::success($matches);
    }

    public function didAllPlay(): JsonResponse
    {
        return ResponseBuilder::success([
            'did_play_all' => $this->matchService->didPlayAll()
        ]);
    }

    public function reset(): JsonResponse
    {
        $this->matchService->reset();
        return ResponseBuilder::success();
    }
}
