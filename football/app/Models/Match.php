<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Match extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function homeStanding(): HasOneThrough
    {
        return $this->hasOneThrough(Standing::class, Team::class, 'id', 'team_id', 'home_team_id');
    }

    public function awayStanding(): HasOneThrough
    {
        return $this->hasOneThrough(Standing::class, Team::class, 'id', 'team_id', 'away_team_id');
    }
}
