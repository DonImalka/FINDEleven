<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Matches - FINDEleven</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">FINDEleven</a>
                <div class="space-x-4">
                    <a href="{{ route('public.matches.upcoming') }}" class="text-gray-700 hover:text-blue-600">Upcoming Matches</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-8">🔴 Live Matches</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($matches as $match)
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</h3>
                            <p class="text-gray-600">{{ $match->venue }}</p>
                        </div>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold animate-pulse">LIVE</span>
                    </div>
                    
                    @if($match->score)
                        <div class="bg-gray-50 p-4 rounded mb-4">
                            <p class="text-3xl font-bold">{{ $match->score->runs }}/{{ $match->score->wickets }}</p>
                            <p class="text-gray-600">({{ number_format($match->score->overs_completed, 1) }} overs)</p>
                        </div>
                    @endif
                    
                    <a href="{{ route('public.scoreboard', $match) }}" class="block w-full bg-blue-500 text-white text-center px-4 py-2 rounded hover:bg-blue-600">
                        View Full Scoreboard
                    </a>
                </div>
            @empty
                <p class="text-gray-500 col-span-2 text-center py-8">No live matches at the moment.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
