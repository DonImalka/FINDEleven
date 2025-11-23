<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Live Score Panel') }} - {{ $match->teamA->name }} vs {{ $match->teamB->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-lg"><strong>Venue:</strong> {{ $match->venue }}</p>
                        <p class="text-lg"><strong>Date:</strong> {{ $match->match_date->format('M d, Y H:i') }}</p>
                        <p class="text-lg"><strong>Overs:</strong> {{ $match->overs }}</p>
                    </div>

                    @livewire('live-score-panel', ['matchId' => $match->id])
                </div>
            </div>

            <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                <p><strong>Public Scoreboard Link:</strong></p>
                <a href="{{ route('public.scoreboard', $match) }}" target="_blank" class="text-blue-900 underline">
                    {{ route('public.scoreboard', $match) }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
