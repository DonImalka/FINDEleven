<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="text-2xl font-bold text-blue-600">
                        FINDEleven
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs(auth()->user()->role . '.*')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->isPlayer())
                        <x-nav-link :href="route('player.organizations')" :active="request()->routeIs('player.organizations*')" wire:navigate>
                            {{ __('Organizations') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isOrganization())
                        <x-nav-link :href="route('organization.requests')" :active="request()->routeIs('organization.requests*')" wire:navigate>
                            {{ __('Player Requests') }}
                        </x-nav-link>
                        <x-nav-link :href="route('organization.matches.create')" :active="request()->routeIs('organization.matches.create')" wire:navigate>
                            {{ __('Create Match') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users*')" wire:navigate>
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.matches')" :active="request()->routeIs('admin.matches*')" wire:navigate>
                            {{ __('Matches') }}
                        </x-nav-link>
                    @endif

                    <!-- Public Links -->
                    <x-nav-link :href="route('public.matches.live')" :active="request()->routeIs('public.matches.live')" wire:navigate>
                        🔴 {{ __('Live Matches') }}
                    </x-nav-link>
                    <x-nav-link :href="route('public.matches.upcoming')" :active="request()->routeIs('public.matches.upcoming')" wire:navigate>
                        {{ __('Upcoming') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-500 border-b">
                            {{ ucfirst(auth()->user()->role) }} Account
                        </div>

                        @if(auth()->user()->isPlayer() && auth()->user()->playerProfile)
                            <x-dropdown-link :href="route('player.profile.edit')" wire:navigate>
                                {{ __('Edit Profile') }}
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Account Settings') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->isPlayer())
                <x-responsive-nav-link :href="route('player.organizations')" :active="request()->routeIs('player.organizations*')" wire:navigate>
                    {{ __('Organizations') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isOrganization())
                <x-responsive-nav-link :href="route('organization.requests')" :active="request()->routeIs('organization.requests*')" wire:navigate>
                    {{ __('Player Requests') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('organization.matches.create')" :active="request()->routeIs('organization.matches.create')" wire:navigate>
                    {{ __('Create Match') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users*')" wire:navigate>
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.matches')" :active="request()->routeIs('admin.matches*')" wire:navigate>
                    {{ __('Matches') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('public.matches.live')" :active="request()->routeIs('public.matches.live')" wire:navigate>
                🔴 {{ __('Live Matches') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('public.matches.upcoming')" :active="request()->routeIs('public.matches.upcoming')" wire:navigate>
                {{ __('Upcoming Matches') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ ucfirst(auth()->user()->role) }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(auth()->user()->isPlayer() && auth()->user()->playerProfile)
                    <x-responsive-nav-link :href="route('player.profile.edit')" wire:navigate>
                        {{ __('Edit Profile') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Account Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
