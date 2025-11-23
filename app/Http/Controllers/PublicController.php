<?php

namespace App\Http\Controllers;

use App\Models\CricketMatch;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $liveMatches = CricketMatch::with(['teamA', 'teamB'])
            ->where('status', 'live')
            ->get();
            
        $upcomingMatches = CricketMatch::with(['teamA', 'teamB'])
            ->where('status', 'upcoming')
            ->orderBy('match_date')
            ->take(5)
            ->get();
        
        return view('public.home', compact('liveMatches', 'upcomingMatches'));
    }
    
    public function upcomingMatches()
    {
        $matches = CricketMatch::with(['teamA', 'teamB'])
            ->where('status', 'upcoming')
            ->orderBy('match_date')
            ->get();
        
        return view('public.matches.upcoming', compact('matches'));
    }
    
    public function liveMatches()
    {
        $matches = CricketMatch::with(['teamA', 'teamB', 'score'])
            ->where('status', 'live')
            ->get();
        
        return view('public.matches.live', compact('matches'));
    }
    
    public function scoreboard(CricketMatch $match)
    {
        $match->load(['teamA', 'teamB', 'score']);
        
        return view('public.scoreboard', compact('match'));
    }
}
