<?php

namespace App\Http\Controllers;

use App\Models\CricketMatch;
use App\Models\Organization;
use App\Models\PlayerOrganizationRequest;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $organization = $user->organization;
        
        if (!$organization) {
            return redirect()->route('organization.profile.create');
        }
        
        // Get pending requests
        $pendingRequests = PlayerOrganizationRequest::where('organization_id', $organization->id)
            ->where('status', 'pending')
            ->with('player')
            ->get();
        
        // Get approved players count
        $approvedPlayersCount = PlayerOrganizationRequest::where('organization_id', $organization->id)
            ->where('status', 'approved')
            ->count();
        
        // Get upcoming matches
        $upcomingMatches = CricketMatch::where(function($query) use ($organization) {
                $query->where('team_a_id', $organization->id)
                      ->orWhere('team_b_id', $organization->id);
            })
            ->where('status', 'upcoming')
            ->with(['teamA', 'teamB'])
            ->orderBy('match_date')
            ->get();
        
        return view('organization.dashboard', compact('organization', 'pendingRequests', 'approvedPlayersCount', 'upcomingMatches'));
    }
    
    public function createProfile()
    {
        return view('organization.profile.create');
    }
    
    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        
        $validated['user_id'] = auth()->id();
        
        Organization::create($validated);
        
        return redirect()->route('organization.dashboard')->with('success', 'Organization profile created successfully!');
    }
    
    public function requests()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return redirect()->route('organization.profile.create');
        }
        
        $requests = PlayerOrganizationRequest::where('organization_id', $organization->id)
            ->with('player')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('organization.requests.index', compact('requests'));
    }
    
    public function approveRequest(PlayerOrganizationRequest $request)
    {
        $organization = auth()->user()->organization;
        
        if ($request->organization_id !== $organization->id) {
            abort(403);
        }
        
        $request->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Player request approved!');
    }
    
    public function rejectRequest(PlayerOrganizationRequest $request)
    {
        $organization = auth()->user()->organization;
        
        if ($request->organization_id !== $organization->id) {
            abort(403);
        }
        
        $request->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Player request rejected!');
    }
}
