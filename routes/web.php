<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;

// Page d'accueil publique
Route::get('/', [AdController::class, 'home'])->name('home');

// Page de détail publique
Route::get('/annonce/{id}', [AdController::class, 'voir'])->name('ads.voir');

// Routes protégées
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion des annonces
    Route::resource('ads', AdController::class);
});

// Route de test 
Route::get('/Blog', function () {
    return [
        'article' => 'Article 1' 
    ];
});

require __DIR__.'/auth.php';