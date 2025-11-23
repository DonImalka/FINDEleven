<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Match</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('organization.matches.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="team_b_id" class="block text-sm font-medium text-gray-700">Opponent Team *</label>
                            <select name="team_b_id" id="team_b_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select opponent...</option>
                                @foreach($organizations as $org)
                                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                                @endforeach
                            </select>
                            @error('team_b_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="venue" class="block text-sm font-medium text-gray-700">Venue *</label>
                            <input type="text" name="venue" id="venue" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label for="match_date" class="block text-sm font-medium text-gray-700">Match Date & Time *</label>
                            <input type="datetime-local" name="match_date" id="match_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label for="overs" class="block text-sm font-medium text-gray-700">Overs Format *</label>
                            <select name="overs" id="overs" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="10">10 Overs</option>
                                <option value="20" selected>20 Overs</option>
                                <option value="50">50 Overs</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Create Match</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
