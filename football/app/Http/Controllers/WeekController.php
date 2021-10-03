<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseBuilder;
use App\Services\WeekService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    private WeekService $weekService;

    public function __construct(WeekService $weekService)
    {
        $this->weekService = $weekService;
    }

    public function index(): JsonResponse
    {
        return ResponseBuilder::success($this->weekService->all());
    }
}
