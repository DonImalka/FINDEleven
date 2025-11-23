<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Player Requests</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">All Player Requests</h3>
                    
                    @forelse($requests as $request)
                        <div class="border-b pb-4 mb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-lg">{{ $request->player->name }}</p>
                                    <p class="text-gray-600">Age: {{ $request->player->age }} | District: {{ $request->player->district }}</p>
                                    @if($request->player->batting_style || $request->player->bowling_style)
                                        <p class="text-sm text-gray-500 mt-1">
                                            @if($request->player->batting_style)Batting: {{ $request->player->batting_style }}@endif
                                            @if($request->player->batting_style && $request->player->bowling_style) | @endif
                                            @if($request->player->bowling_style)Bowling: {{ $request->player->bowling_style }}@endif
                                        </p>
                                    @endif
                                    <p class="text-sm text-gray-500 mt-2">Requested: {{ $request->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    <span class="px-3 py-1 rounded text-sm font-semibold
                                        @if($request->status === 'pending') bg-yellow-200 text-yellow-800
                                        @elseif($request->status === 'approved') bg-green-200 text-green-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    
                                    @if($request->status === 'pending')
                                        <div class="flex gap-2 mt-2">
                                            <form method="POST" action="{{ route('organization.requests.approve', $request) }}">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('organization.requests.reject', $request) }}">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No player requests yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
