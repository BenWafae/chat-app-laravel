<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Page d'accueil accessible à tous
Route::get('/', function () {
    return view('welcome'); // ici tu peux mettre ta page d'accueil avec login/register
});

// Dashboard accessible uniquement aux utilisateurs authentifiés
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  
// route pour User

Route::middleware(['auth', 'role.user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');
        Route::get('/messages/{user}', [ChatController::class, 'getMessages'])->name('chat.messages');

    });
});
// Auth routes
require __DIR__.'/auth.php';
