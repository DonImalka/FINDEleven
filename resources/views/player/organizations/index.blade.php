<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Browse Organizations</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            @if($existingRequest)
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                    You already have a request to join <strong>{{ $existingRequest->organization->name }}</strong> (Status: {{ ucfirst($existingRequest->status) }})
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($organizations as $organization)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $organization->name }}</h3>
                        @if($organization->district)
                            <p class="text-gray-600 mb-2">📍 {{ $organization->district }}</p>
                        @endif
                        @if($organization->description)
                            <p class="text-gray-700 mb-4">{{ Str::limit($organization->description, 100) }}</p>
                        @endif
                        
                        @if(!$existingRequest)
                            <form method="POST" action="{{ route('player.organizations.request', $organization) }}">
                                @csrf
                                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Request to Join
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3 text-center py-8">No organizations available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
