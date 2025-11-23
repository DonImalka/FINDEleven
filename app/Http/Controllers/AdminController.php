<?php

namespace App\Http\Controllers;

use App\Models\CricketMatch;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPlayers = User::where('role', 'player')->count();
        $totalOrganizations = User::where('role', 'organization')->count();
        $totalMatches = CricketMatch::count();
        $liveMatches = CricketMatch::where('status', 'live')->count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalPlayers', 'totalOrganizations', 'totalMatches', 'liveMatches'));
    }
    
    public function users()
    {
        $users = User::with(['playerProfile', 'organization'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.users.index', compact('users'));
    }
    
    public function banUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot ban admin users.');
        }
        
        $user->update(['status' => 'banned']);
        
        return redirect()->back()->with('success', 'User banned successfully!');
    }
    
    public function activateUser(User $user)
    {
        $user->update(['status' => 'active']);
        
        return redirect()->back()->with('success', 'User activated successfully!');
    }
    
    public function matches()
    {
        $matches = CricketMatch::with(['teamA', 'teamB', 'score'])
            ->orderBy('match_date', 'desc')
            ->get();
        
        return view('admin.matches.index', compact('matches'));
    }
    
    public function updateMatchStatus(Request $request, CricketMatch $match)
    {
        $validated = $request->validate([
            'status' => 'required|in:upcoming,live,finished',
        ]);
        
        $match->update($validated);
        
        return redirect()->back()->with('success', 'Match status updated!');
    }
}
