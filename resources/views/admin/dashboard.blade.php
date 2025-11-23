<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.users') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm font-semibold">
                    Manage Users
                </a>
                <a href="{{ route('admin.matches') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm font-semibold">
                    Manage Matches
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- System Overview -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-2">System Overview</h3>
                <p class="opacity-90">Monitor and manage the FINDEleven cricket talent platform</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="text-4xl">👥</div>
                        </div>
                        <a href="{{ route('admin.users') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-800">
                            View All →
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Players</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPlayers }}</p>
                            </div>
                            <div class="text-4xl">🏏</div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">Registered players</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-yellow-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Organizations</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrganizations }}</p>
                            </div>
                            <div class="text-4xl">🏢</div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">Cricket clubs</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Matches</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalMatches }}</p>
                            </div>
                            <div class="text-4xl">🎯</div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            <span class="text-red-600 font-semibold">{{ $liveMatches }}</span> currently live
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">⚡ Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.users') }}" class="border-2 border-blue-200 rounded-lg p-6 hover:border-blue-400 hover:bg-blue-50 transition group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 group-hover:text-blue-600">Manage Users</h4>
                                    <p class="text-gray-600 text-sm mt-1">View, ban, or activate user accounts</p>
                                </div>
                                <div class="text-3xl">👤</div>
                            </div>
                        </a>

                        <a href="{{ route('admin.matches') }}" class="border-2 border-green-200 rounded-lg p-6 hover:border-green-400 hover:bg-green-50 transition group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 group-hover:text-green-600">Manage Matches</h4>
                                    <p class="text-gray-600 text-sm mt-1">Control match status and visibility</p>
                                </div>
                                <div class="text-3xl">⚙️</div>
                            </div>
                        </a>

                        <a href="{{ route('public.matches.live') }}" class="border-2 border-red-200 rounded-lg p-6 hover:border-red-400 hover:bg-red-50 transition group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 group-hover:text-red-600">View Live Matches</h4>
                                    <p class="text-gray-600 text-sm mt-1">Monitor ongoing cricket matches</p>
                                </div>
                                <div class="text-3xl">🔴</div>
                            </div>
                        </a>

                        <a href="{{ route('public.matches.upcoming') }}" class="border-2 border-purple-200 rounded-lg p-6 hover:border-purple-400 hover:bg-purple-50 transition group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 group-hover:text-purple-600">Upcoming Matches</h4>
                                    <p class="text-gray-600 text-sm mt-1">View scheduled matches</p>
                                </div>
                                <div class="text-3xl">📅</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">ℹ️ System Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Platform Features</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li>✓ Role-based access control (Player, Organization, Admin)</li>
                                <li>✓ Live cricket scoring with real-time updates</li>
                                <li>✓ Public scoreboards accessible without login</li>
                                <li>✓ Player-organization management system</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Admin Capabilities</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li>✓ User management (ban/activate accounts)</li>
                                <li>✓ Match status control (upcoming/live/finished)</li>
                                <li>✓ System monitoring and oversight</li>
                                <li>✓ Full platform visibility</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
