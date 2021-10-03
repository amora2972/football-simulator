<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseBuilder;
use App\Services\MatchService;
use App\Services\TeamService;
use App\Services\WeekService;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    private TeamService $teamService;
    private WeekService $weekService;
    private MatchService $matchService;

    public function __construct(TeamService $teamService, WeekService $weekService, MatchService $matchService)
    {
        $this->teamService = $teamService;
        $this->weekService = $weekService;
        $this->matchService = $matchService;
    }

    public function index(): JsonResponse
    {
        $teams = $this->teamService->all();
        $weeks = $this->weekService->all();
        $didPlayAll = $this->matchService->didPlayAll();

        return ResponseBuilder::success([
            'teams' => $teams,
            'weeks' => $weeks,
            'did_play_all' => $didPlayAll,
        ]);
    }
}
