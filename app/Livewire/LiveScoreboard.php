<?php

namespace App\Livewire;

use App\Models\CricketMatch;
use Livewire\Component;

class LiveScoreboard extends Component
{
    public $matchId;
    public $match;
    
    public function mount($matchId)
    {
        $this->matchId = $matchId;
        $this->loadMatch();
    }
    
    public function loadMatch()
    {
        $this->match = CricketMatch::with(['teamA', 'teamB', 'score'])
            ->find($this->matchId);
    }
    
    public function render()
    {
        // Refresh match data on every render (for polling)
        $this->loadMatch();
        
        return view('livewire.live-scoreboard');
    }
}
