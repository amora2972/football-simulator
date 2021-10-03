<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Services\WeekService;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    private WeekService $weekService;

    public function __construct(WeekService $weekService)
    {
        $this->weekService = $weekService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->weekService->generateWeeks(Team::get());
    }
}
