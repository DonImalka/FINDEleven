<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'district',
        'batting_style',
        'bowling_style',
        'bio',
    ];

    /**
     * Get the user that owns the player profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the organizations this player has requested to join.
     */
    public function organizationRequests()
    {
        return $this->hasMany(PlayerOrganizationRequest::class, 'player_id');
    }

    /**
     * Get the organizations this player is approved for.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'player_organization_requests', 'player_id', 'organization_id')
            ->wherePivot('status', 'approved');
    }
}
