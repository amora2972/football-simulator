<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Facades\Cache;

class TeamService
{
    public function all()
    {
        return Team::get();
    }
}
