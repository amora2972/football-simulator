<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\JsonResponse;
use App\Helpers\ResponseBuilder;

class TeamController extends Controller
{
    private TeamService $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index(): JsonResponse
    {
        return ResponseBuilder::success($this->teamService->all());
    }
}
