<?php

namespace App\Livewire;

use App\Models\Score;
use Livewire\Component;

class LiveScorePanel extends Component
{
    public $matchId;
    public $score;
    
    public $team_batting;
    public $runs;
    public $wickets;
    public $overs_completed;
    public $striker_name;
    public $non_striker_name;
    public $bowler_name;
    public $last_ball_comment;
    
    public function mount($matchId)
    {
        $this->matchId = $matchId;
        $this->score = Score::where('match_id', $matchId)->first();
        
        if ($this->score) {
            $this->team_batting = $this->score->team_batting;
            $this->runs = $this->score->runs;
            $this->wickets = $this->score->wickets;
            $this->overs_completed = $this->score->overs_completed;
            $this->striker_name = $this->score->striker_name;
            $this->non_striker_name = $this->score->non_striker_name;
            $this->bowler_name = $this->score->bowler_name;
            $this->last_ball_comment = $this->score->last_ball_comment;
        }
    }
    
    public function updateScore()
    {
        $this->validate([
            'team_batting' => 'nullable|string|max:255',
            'runs' => 'required|integer|min:0',
            'wickets' => 'required|integer|min:0|max:10',
            'overs_completed' => 'required|numeric|min:0',
            'striker_name' => 'nullable|string|max:255',
            'non_striker_name' => 'nullable|string|max:255',
            'bowler_name' => 'nullable|string|max:255',
            'last_ball_comment' => 'nullable|string|max:500',
        ]);
        
        $this->score->update([
            'team_batting' => $this->team_batting,
            'runs' => $this->runs,
            'wickets' => $this->wickets,
            'overs_completed' => $this->overs_completed,
            'striker_name' => $this->striker_name,
            'non_striker_name' => $this->non_striker_name,
            'bowler_name' => $this->bowler_name,
            'last_ball_comment' => $this->last_ball_comment,
        ]);
        
        session()->flash('message', 'Score updated successfully!');
    }
    
    public function render()
    {
        return view('livewire.live-score-panel');
    }
}
