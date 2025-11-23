<?php

namespace App\Http\Controllers;

use App\Models\CricketMatch;
use App\Models\Organization;
use App\Models\PlayerOrganizationRequest;
use App\Models\PlayerProfile;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $profile = $user->playerProfile;
        
        // Get player's organization request
        $request = null;
        if ($profile) {
            $request = PlayerOrganizationRequest::where('player_id', $profile->id)
                ->with('organization')
                ->first();
        }
        
        // Get upcoming and live matches
        $upcomingMatches = CricketMatch::with(['teamA', 'teamB'])
            ->where('status', 'upcoming')
            ->orderBy('match_date')
            ->take(5)
            ->get();
            
        $liveMatches = CricketMatch::with(['teamA', 'teamB'])
            ->where('status', 'live')
            ->get();
        
        return view('player.dashboard', compact('profile', 'request', 'upcomingMatches', 'liveMatches'));
    }
    
    public function createProfile()
    {
        return view('player.profile.create');
    }
    
    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10|max:100',
            'district' => 'required|string|max:255',
            'batting_style' => 'nullable|string|max:255',
            'bowling_style' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        $validated['user_id'] = auth()->id();
        
        PlayerProfile::create($validated);
        
        return redirect()->route('player.dashboard')->with('success', 'Profile created successfully!');
    }
    
    public function editProfile()
    {
        $profile = auth()->user()->playerProfile;
        
        if (!$profile) {
            return redirect()->route('player.profile.create');
        }
        
        return view('player.profile.edit', compact('profile'));
    }
    
    public function updateProfile(Request $request)
    {
        $profile = auth()->user()->playerProfile;
        
        if (!$profile) {
            return redirect()->route('player.profile.create');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10|max:100',
            'district' => 'required|string|max:255',
            'batting_style' => 'nullable|string|max:255',
            'bowling_style' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);
        
        $profile->update($validated);
        
        return redirect()->route('player.dashboard')->with('success', 'Profile updated successfully!');
    }
    
    public function organizations()
    {
        $organizations = Organization::all();
        $profile = auth()->user()->playerProfile;
        
        // Check if player already has a request
        $existingRequest = null;
        if ($profile) {
            $existingRequest = PlayerOrganizationRequest::where('player_id', $profile->id)->first();
        }
        
        return view('player.organizations.index', compact('organizations', 'existingRequest'));
    }
    
    public function requestJoin(Organization $organization)
    {
        $profile = auth()->user()->playerProfile;
        
        if (!$profile) {
            return redirect()->route('player.profile.create')
                ->with('error', 'Please create your profile first.');
        }
        
        // Check if already has a request
        $existingRequest = PlayerOrganizationRequest::where('player_id', $profile->id)->first();
        
        if ($existingRequest) {
            return redirect()->back()->with('error', 'You already have a pending request.');
        }
        
        PlayerOrganizationRequest::create([
            'player_id' => $profile->id,
            'organization_id' => $organization->id,
            'status' => 'pending',
        ]);
        
        return redirect()->route('player.dashboard')
            ->with('success', 'Request sent successfully!');
    }
}
