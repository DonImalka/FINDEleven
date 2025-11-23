<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'district',
        'description',
    ];

    /**
     * Get the user that owns the organization.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the player requests for this organization.
     */
    public function playerRequests()
    {
        return $this->hasMany(PlayerOrganizationRequest::class, 'organization_id');
    }

    /**
     * Get the approved players for this organization.
     */
    public function players()
    {
        return $this->belongsToMany(PlayerProfile::class, 'player_organization_requests', 'organization_id', 'player_id')
            ->wherePivot('status', 'approved');
    }

    /**
     * Get matches where this organization is team A.
     */
    public function matchesAsTeamA()
    {
        return $this->hasMany(CricketMatch::class, 'team_a_id');
    }

    /**
     * Get matches where this organization is team B.
     */
    public function matchesAsTeamB()
    {
        return $this->hasMany(CricketMatch::class, 'team_b_id');
    }

    /**
     * Get all matches for this organization.
     */
    public function matches()
    {
        return CricketMatch::where('team_a_id', $this->id)
            ->orWhere('team_b_id', $this->id);
    }
}
