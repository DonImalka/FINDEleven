<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Organization Dashboard') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('organization.matches.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm font-semibold">
                    + Create Match
                </a>
                <a href="{{ route('organization.requests') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm font-semibold">
                    View All Requests
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Pending Requests</p>
                                <p class="text-4xl font-bold mt-2">{{ $pendingRequests->count() }}</p>
                            </div>
                            <div class="text-5xl opacity-50">⏳</div>
                        </div>
                        @if($pendingRequests->count() > 0)
                            <a href="{{ route('organization.requests') }}" class="mt-4 inline-block text-sm text-white underline hover:text-yellow-100">
                                Review Now →
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-400 to-green-500 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Approved Players</p>
                                <p class="text-4xl font-bold mt-2">{{ $approvedPlayersCount }}</p>
                            </div>
                            <div class="text-5xl opacity-50">👥</div>
                        </div>
                        <p class="mt-4 text-sm opacity-90">Active team members</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-400 to-blue-500 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium opacity-90">Upcoming Matches</p>
                                <p class="text-4xl font-bold mt-2">{{ $upcomingMatches->count() }}</p>
                            </div>
                            <div class="text-5xl opacity-50">🏏</div>
                        </div>
                        <a href="{{ route('organization.matches.create') }}" class="mt-4 inline-block text-sm text-white underline hover:text-blue-100">
                            Create New Match →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Player Requests -->
            @if($pendingRequests->count() > 0)
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">⏳ Pending Player Requests</h3>
                        <span class="bg-white text-yellow-600 px-3 py-1 rounded-full text-sm font-bold">
                            {{ $pendingRequests->count() }}
                        </span>
                    </div>
                    <div class="p-6">
                        @foreach($pendingRequests as $request)
                            <div class="border-2 border-yellow-200 rounded-lg p-4 mb-4 last:mb-0 hover:border-yellow-400 transition">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-bold text-lg">{{ $request->player->name }}</p>
                                        <div class="mt-2 space-y-1">
                                            <p class="text-gray-600 text-sm">📍 {{ $request->player->district }} • Age: {{ $request->player->age }}</p>
                                            @if($request->player->batting_style || $request->player->bowling_style)
                                                <p class="text-gray-600 text-sm">
                                                    @if($request->player->batting_style)🏏 {{ $request->player->batting_style }}@endif
                                                    @if($request->player->batting_style && $request->player->bowling_style) • @endif
                                                    @if($request->player->bowling_style)⚾ {{ $request->player->bowling_style }}@endif
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-2 ml-4">
                                        <form method="POST" action="{{ route('organization.requests.approve', $request) }}">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded font-semibold hover:bg-green-600 transition">
                                                ✓ Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('organization.requests.reject', $request) }}">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-semibold hover:bg-red-600 transition">
                                                ✗ Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Upcoming Matches -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">🏏 Your Upcoming Matches</h3>
                    <a href="{{ route('organization.matches.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded font-semibold hover:bg-blue-50 transition text-sm">
                        + Create Match
                    </a>
                </div>
                <div class="p-6">
                    @forelse($upcomingMatches as $match)
                        <div class="border-2 border-blue-200 rounded-lg p-4 mb-4 last:mb-0 hover:border-blue-400 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-bold text-lg mb-2">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</p>
                                    <div class="space-y-1">
                                        <p class="text-gray-600 text-sm">📍 {{ $match->venue }}</p>
                                        <p class="text-gray-600 text-sm">📅 {{ $match->match_date->format('M d, Y') }} at {{ $match->match_date->format('H:i') }}</p>
                                        <p class="text-gray-600 text-sm">⏱️ {{ $match->overs }} Overs Format</p>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('organization.matches.score-panel', $match) }}" class="block bg-blue-500 text-white px-4 py-2 rounded font-semibold hover:bg-blue-600 transition text-center mb-2">
                                        Manage Score
                                    </a>
                                    <a href="{{ route('public.scoreboard', $match) }}" target="_blank" class="block bg-gray-200 text-gray-700 px-4 py-2 rounded font-semibold hover:bg-gray-300 transition text-center text-sm">
                                        View Public Link
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">No upcoming matches scheduled.</p>
                            <a href="{{ route('organization.matches.create') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                                Create Your First Match →
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
