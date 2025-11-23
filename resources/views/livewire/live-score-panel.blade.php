<div>
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateScore">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="team_batting" class="block text-sm font-medium text-gray-700">Team Batting</label>
                <input type="text" wire:model="team_batting" id="team_batting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('team_batting') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="runs" class="block text-sm font-medium text-gray-700">Runs *</label>
                <input type="number" wire:model="runs" id="runs" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('runs') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="wickets" class="block text-sm font-medium text-gray-700">Wickets *</label>
                <input type="number" wire:model="wickets" id="wickets" required min="0" max="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('wickets') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="overs_completed" class="block text-sm font-medium text-gray-700">Overs Completed *</label>
                <input type="number" wire:model="overs_completed" id="overs_completed" required step="0.1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('overs_completed') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="striker_name" class="block text-sm font-medium text-gray-700">Striker</label>
                <input type="text" wire:model="striker_name" id="striker_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('striker_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="non_striker_name" class="block text-sm font-medium text-gray-700">Non-Striker</label>
                <input type="text" wire:model="non_striker_name" id="non_striker_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('non_striker_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="bowler_name" class="block text-sm font-medium text-gray-700">Bowler</label>
                <input type="text" wire:model="bowler_name" id="bowler_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('bowler_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-4">
            <label for="last_ball_comment" class="block text-sm font-medium text-gray-700">Last Ball Commentary</label>
            <textarea wire:model="last_ball_comment" id="last_ball_comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., FOUR! Beautiful cover drive"></textarea>
            @error('last_ball_comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 font-semibold">
                Update Score
            </button>
        </div>
    </form>

    <div class="mt-4 p-4 bg-gray-100 rounded">
        <h4 class="font-semibold mb-2">Current Score Preview:</h4>
        <p class="text-2xl font-bold">{{ $runs }}/{{ $wickets }} ({{ $overs_completed }} overs)</p>
        @if($striker_name || $non_striker_name)
            <p class="text-sm mt-2">
                @if($striker_name)<strong>{{ $striker_name }}*</strong>@endif
                @if($striker_name && $non_striker_name), @endif
                @if($non_striker_name){{ $non_striker_name }}@endif
            </p>
        @endif
        @if($bowler_name)
            <p class="text-sm">Bowling: {{ $bowler_name }}</p>
        @endif
    </div>
</div>
