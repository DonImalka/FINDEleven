<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Matches</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Match</th>
                                <th class="px-4 py-2 text-left">Venue</th>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($matches as $match)
                                <tr>
                                    <td class="px-4 py-2">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</td>
                                    <td class="px-4 py-2">{{ $match->venue }}</td>
                                    <td class="px-4 py-2">{{ $match->match_date->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-sm 
                                            @if($match->status === 'live') bg-red-200 text-red-800
                                            @elseif($match->status === 'upcoming') bg-blue-200 text-blue-800
                                            @else bg-gray-200 text-gray-800 @endif">
                                            {{ ucfirst($match->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="{{ route('admin.matches.status', $match) }}" class="inline">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 rounded">
                                                <option value="upcoming" {{ $match->status === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                                <option value="live" {{ $match->status === 'live' ? 'selected' : '' }}>Live</option>
                                                <option value="finished" {{ $match->status === 'finished' ? 'selected' : '' }}>Finished</option>
                                            </select>
                                        </form>
                                        <a href="{{ route('public.scoreboard', $match) }}" target="_blank" class="text-blue-600 underline text-sm ml-2">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
