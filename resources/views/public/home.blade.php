<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINDEleven - Cricket Talent Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-600">FINDEleven</h1>
                <div class="space-x-4">
                    <a href="{{ route('public.matches.upcoming') }}" class="text-gray-700 hover:text-blue-600">Upcoming Matches</a>
                    <a href="{{ route('public.matches.live') }}" class="text-gray-700 hover:text-blue-600">Live Matches</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Discover Local Cricket Talent in Sri Lanka</h2>
            <p class="text-xl text-gray-600">Connect players with organizations and follow live cricket matches</p>
        </div>

        <!-- Live Matches -->
        @if($liveMatches->count() > 0)
            <div class="mb-12">
                <h3 class="text-2xl font-bold mb-6">🔴 Live Matches</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($liveMatches as $match)
                        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-xl font-bold">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</h4>
                                    <p class="text-gray-600">{{ $match->venue }}</p>
                                </div>
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold animate-pulse">LIVE</span>
                            </div>
                            <a href="{{ route('public.scoreboard', $match) }}" class="block w-full bg-blue-500 text-white text-center px-4 py-2 rounded hover:bg-blue-600">
                                View Live Scoreboard
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Upcoming Matches -->
        <div>
            <h3 class="text-2xl font-bold mb-6">Upcoming Matches</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($upcomingMatches as $match)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h4 class="font-bold text-lg mb-2">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</h4>
                        <p class="text-gray-600 text-sm mb-1">📍 {{ $match->venue }}</p>
                        <p class="text-gray-600 text-sm mb-1">📅 {{ $match->match_date->format('M d, Y') }}</p>
                        <p class="text-gray-600 text-sm">⏰ {{ $match->match_date->format('H:i') }}</p>
                        <p class="text-blue-600 font-semibold mt-2">{{ $match->overs }} Overs</p>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3 text-center py-8">No upcoming matches scheduled.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
