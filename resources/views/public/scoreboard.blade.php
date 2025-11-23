<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Scoreboard - {{ $match->teamA->name }} vs {{ $match->teamB->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h1 class="text-3xl font-bold text-center mb-2">LIVE CRICKET MATCH</h1>
                    <p class="text-center text-blue-100">{{ $match->venue }}</p>
                </div>

                <!-- Livewire Scoreboard Component -->
                @livewire('live-scoreboard', ['matchId' => $match->id])

                <!-- Footer -->
                <div class="bg-gray-50 p-4 text-center text-sm text-gray-600">
                    <p>Auto-refreshing every 5 seconds</p>
                    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
