<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketMatch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'team_a_id',
        'team_b_id',
        'venue',
        'match_date',
        'overs',
        'status',
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    /**
     * Get team A (organization).
     */
    public function teamA()
    {
        return $this->belongsTo(Organization::class, 'team_a_id');
    }

    /**
     * Get team B (organization).
     */
    public function teamB()
    {
        return $this->belongsTo(Organization::class, 'team_b_id');
    }

    /**
     * Get the score for this match.
     */
    public function score()
    {
        return $this->hasOne(Score::class, 'match_id');
    }

    /**
     * Scope a query to only include upcoming matches.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    /**
     * Scope a query to only include live matches.
     */
    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    /**
     * Scope a query to only include finished matches.
     */
    public function scopeFinished($query)
    {
        return $query->where('status', 'finished');
    }
}
