<?php

namespace App\Http\Controllers;

use App\Models\CricketMatch;
use App\Models\Organization;
use App\Models\Score;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function create()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return redirect()->route('organization.profile.create');
        }
        
        // Get all other organizations
        $organizations = Organization::where('id', '!=', $organization->id)->get();
        
        return view('organization.matches.create', compact('organizations'));
    }
    
    public function store(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return redirect()->route('organization.profile.create');
        }
        
        $validated = $request->validate([
            'team_b_id' => 'required|exists:organizations,id',
            'venue' => 'required|string|max:255',
            'match_date' => 'required|date|after:now',
            'overs' => 'required|in:10,20,50',
        ]);
        
        $validated['team_a_id'] = $organization->id;
        $validated['status'] = 'upcoming';
        
        $match = CricketMatch::create($validated);
        
        // Create initial score record
        Score::create([
            'match_id' => $match->id,
            'runs' => 0,
            'wickets' => 0,
            'overs_completed' => 0,
        ]);
        
        return redirect()->route('organization.dashboard')
            ->with('success', 'Match created successfully!');
    }
    
    public function scorePanel(CricketMatch $match)
    {
        $organization = auth()->user()->organization;
        
        // Check if this organization is part of the match
        if ($match->team_a_id !== $organization->id && $match->team_b_id !== $organization->id) {
            abort(403);
        }
        
        $score = $match->score ?? Score::create([
            'match_id' => $match->id,
            'runs' => 0,
            'wickets' => 0,
            'overs_completed' => 0,
        ]);
        
        return view('organization.matches.score-panel', compact('match', 'score'));
    }
}
