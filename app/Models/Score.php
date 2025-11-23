<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'team_batting',
        'runs',
        'wickets',
        'overs_completed',
        'striker_name',
        'non_striker_name',
        'bowler_name',
        'last_ball_comment',
    ];

    protected $casts = [
        'overs_completed' => 'decimal:2',
    ];

    /**
     * Get the match that owns the score.
     */
    public function match()
    {
        return $this->belongsTo(CricketMatch::class, 'match_id');
    }
}
