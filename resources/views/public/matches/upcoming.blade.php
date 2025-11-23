<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Matches - FINDEleven</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">FINDEleven</a>
                <div class="space-x-4">
                    <a href="{{ route('public.matches.live') }}" class="text-gray-700 hover:text-blue-600">Live Matches</a>
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
        <h1 class="text-3xl font-bold mb-8">Upcoming Matches</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($matches as $match)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-bold text-lg mb-2">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</h3>
                    <p class="text-gray-600 text-sm mb-1">📍 {{ $match->venue }}</p>
                    <p class="text-gray-600 text-sm mb-1">📅 {{ $match->match_date->format('M d, Y') }}</p>
                    <p class="text-gray-600 text-sm">⏰ {{ $match->match_date->format('H:i') }}</p>
                    <p class="text-blue-600 font-semibold mt-2">{{ $match->overs }} Overs</p>
                </div>
            @empty
                <p class="text-gray-500 col-span-3 text-center py-8">No upcoming matches.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
