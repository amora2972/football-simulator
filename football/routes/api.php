<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WeekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('home', [HomeController::class, 'index']);

Route::get('weeks', [WeekController::class, 'index']);
Route::get('teams', [TeamController::class, 'index']);

Route::post('matches/generate', [MatchController::class, 'generate']);

Route::get('matches/{week}', [MatchController::class, 'week']);

Route::post('matches/play/{week}', [MatchController::class, 'play']);

Route::get('standings', [StandingController::class, 'index']);

Route::get('matches/played/all', [MatchController::class, 'didAllPlay']);

Route::post('matches/reset', [MatchController::class, 'reset']);

Route::get('matches/left/predict', [StandingController::class, 'predict']);
