<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerOrganizationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'organization_id',
        'status',
    ];

    /**
     * Get the player that made the request.
     */
    public function player()
    {
        return $this->belongsTo(PlayerProfile::class, 'player_id');
    }

    /**
     * Get the organization for this request.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
