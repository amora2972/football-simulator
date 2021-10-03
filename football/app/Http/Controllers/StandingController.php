<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseBuilder;
use App\Models\Standing;
use App\Services\StandingService;
use Illuminate\Http\JsonResponse;

class StandingController extends Controller
{
    private StandingService $standingService;

    public function __construct(StandingService $standingService)
    {
        $this->standingService = $standingService;
    }

    public function index(): JsonResponse
    {
        return ResponseBuilder::success(Standing::with('team')->get());
    }

    public function predict(): JsonResponse
    {
        return ResponseBuilder::success($this->standingService->predictAllLeftMatches());
    }
}
