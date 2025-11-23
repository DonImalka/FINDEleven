<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/matches/upcoming', [PublicController::class, 'upcomingMatches'])->name('public.matches.upcoming');
Route::get('/matches/live', [PublicController::class, 'liveMatches'])->name('public.matches.live');
Route::get('/scoreboard/{match}', [PublicController::class, 'scoreboard'])->name('public.scoreboard');

// Dashboard router - redirects based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->isPlayer()) {
        return redirect()->route('player.dashboard');
    } elseif ($user->isOrganization()) {
        return redirect()->route('organization.dashboard');
    } elseif ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    
    abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

// Player routes
Route::middleware(['auth', 'role:player'])->prefix('player')->name('player.')->group(function () {
    Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/create', [PlayerController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [PlayerController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [PlayerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [PlayerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/organizations', [PlayerController::class, 'organizations'])->name('organizations');
    Route::post('/organizations/{organization}/request', [PlayerController::class, 'requestJoin'])->name('organizations.request');
});

// Organization routes
Route::middleware(['auth', 'role:organization'])->prefix('organization')->name('organization.')->group(function () {
    Route::get('/dashboard', [OrganizationController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/create', [OrganizationController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [OrganizationController::class, 'storeProfile'])->name('profile.store');
    Route::get('/requests', [OrganizationController::class, 'requests'])->name('requests');
    Route::post('/requests/{request}/approve', [OrganizationController::class, 'approveRequest'])->name('requests.approve');
    Route::post('/requests/{request}/reject', [OrganizationController::class, 'rejectRequest'])->name('requests.reject');
    Route::get('/matches/create', [MatchController::class, 'create'])->name('matches.create');
    Route::post('/matches', [MatchController::class, 'store'])->name('matches.store');
    Route::get('/matches/{match}/score-panel', [MatchController::class, 'scorePanel'])->name('matches.score-panel');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/ban', [AdminController::class, 'banUser'])->name('users.ban');
    Route::post('/users/{user}/activate', [AdminController::class, 'activateUser'])->name('users.activate');
    Route::get('/matches', [AdminController::class, 'matches'])->name('matches');
    Route::post('/matches/{match}/status', [AdminController::class, 'updateMatchStatus'])->name('matches.status');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
