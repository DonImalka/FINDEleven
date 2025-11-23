<div wire:poll.5s>
    @if($match && $match->score)
        <!-- Match Title -->
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold text-center mb-2">
                {{ $match->teamA->name }} vs {{ $match->teamB->name }}
            </h2>
            <p class="text-center text-gray-600">{{ $match->overs }} Overs Match</p>
        </div>

        <!-- Score Display -->
        <div class="p-8 bg-gradient-to-br from-green-50 to-blue-50">
            @if($match->score->team_batting)
                <p class="text-center text-lg text-gray-700 mb-2">{{ $match->score->team_batting }}</p>
            @endif
            
            <div class="text-center">
                <p class="text-6xl font-bold text-gray-900 mb-2">
                    {{ $match->score->runs }}/{{ $match->score->wickets }}
                </p>
                <p class="text-2xl text-gray-600">
                    ({{ number_format($match->score->overs_completed, 1) }} overs)
                </p>
            </div>
        </div>

        <!-- Current Players -->
        @if($match->score->striker_name || $match->score->non_striker_name || $match->score->bowler_name)
            <div class="p-6 bg-gray-50 border-b">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($match->score->striker_name || $match->score->non_striker_name)
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Batsmen</h3>
                            @if($match->score->striker_name)
                                <p class="text-lg"><strong>{{ $match->score->striker_name }}</strong> *</p>
                            @endif
                            @if($match->score->non_striker_name)
                                <p class="text-lg">{{ $match->score->non_striker_name }}</p>
                            @endif
                        </div>
                    @endif
                    
                    @if($match->score->bowler_name)
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Bowler</h3>
                            <p class="text-lg">{{ $match->score->bowler_name }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Last Ball Commentary -->
        @if($match->score->last_ball_comment)
            <div class="p-6 bg-yellow-50">
                <h3 class="font-semibold text-gray-700 mb-2">Last Ball</h3>
                <p class="text-lg italic">"{{ $match->score->last_ball_comment }}"</p>
            </div>
        @endif

        <!-- Match Status -->
        <div class="p-4 bg-gray-100 text-center">
            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold
                @if($match->status === 'live') bg-red-500 text-white animate-pulse
                @elseif($match->status === 'upcoming') bg-blue-500 text-white
                @else bg-gray-500 text-white @endif">
                {{ strtoupper($match->status) }}
            </span>
        </div>
    @else
        <div class="p-8 text-center text-gray-500">
            <p>Score information not available yet.</p>
        </div>
    @endif
</div>
