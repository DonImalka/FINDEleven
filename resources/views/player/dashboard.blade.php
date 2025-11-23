<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Player Dashboard') }}
            </h2>
            @if($profile)
                <a href="{{ route('player.profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                    Edit Profile
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(!$profile)
                <!-- Profile Creation Alert -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold mb-2">Welcome to FINDEleven!</h3>
                    <p class="mb-4">Create your player profile to get started and join organizations.</p>
                    <a href="{{ route('player.profile.create') }}" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Create Your Profile →
                    </a>
                </div>
            @else
                <!-- Profile Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Your Cricket Profile</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Name</h4>
                                <p class="text-lg font-semibold">{{ $profile->name }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Age</h4>
                                <p class="text-lg font-semibold">{{ $profile->age }} years</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">District</h4>
                                <p class="text-lg font-semibold">{{ $profile->district }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Batting Style</h4>
                                <p class="text-lg">{{ $profile->batting_style ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Bowling Style</h4>
                                <p class="text-lg">{{ $profile->bowling_style ?? 'Not specified' }}</p>
                            </div>
                        </div>
                        @if($profile->bio)
                            <div class="mt-4 pt-4 border-t">
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Bio</h4>
                                <p class="text-gray-700">{{ $profile->bio }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Organization Status Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Organization Status</h3>
                    </div>
                    <div class="p-6">
                        @if($request)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-semibold mb-2">{{ $request->organization->name }}</p>
                                    <p class="text-gray-600">Request Status: 
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                            @if($request->status === 'pending') bg-yellow-200 text-yellow-800
                                            @elseif($request->status === 'approved') bg-green-200 text-green-800
                                            @else bg-red-200 text-red-800 @endif">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </p>
                                    @if($request->status === 'approved')
                                        <p class="text-green-600 mt-2">✓ You are now a member of this organization!</p>
                                    @elseif($request->status === 'pending')
                                        <p class="text-gray-500 mt-2">Waiting for organization approval...</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-600 mb-4">You haven't joined any organization yet.</p>
                                <a href="{{ route('player.organizations') }}" class="inline-block bg-purple-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-600 transition">
                                    Browse Organizations →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Live Matches Section -->
            @if($liveMatches->count() > 0)
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <span class="animate-pulse mr-2">🔴</span> Live Matches
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($liveMatches as $match)
                                <div class="border-2 border-red-200 rounded-lg p-4 hover:border-red-400 transition">
                                    <p class="font-bold text-lg mb-2">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</p>
                                    <p class="text-gray-600 text-sm mb-3">📍 {{ $match->venue }}</p>
                                    <a href="{{ route('public.scoreboard', $match) }}" class="block w-full bg-red-500 text-white text-center px-4 py-2 rounded hover:bg-red-600 font-semibold">
                                        View Live Scoreboard →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Upcoming Matches Section -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Upcoming Matches</h3>
                    <a href="{{ route('public.matches.upcoming') }}" class="text-white hover:text-blue-100 text-sm">
                        View All →
                    </a>
                </div>
                <div class="p-6">
                    @forelse($upcomingMatches as $match)
                        <div class="border-b pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-lg">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</p>
                                    <p class="text-gray-600 text-sm mt-1">📍 {{ $match->venue }}</p>
                                    <p class="text-gray-600 text-sm">📅 {{ $match->match_date->format('M d, Y') }} at {{ $match->match_date->format('H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $match->overs }} Overs
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No upcoming matches scheduled.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
