<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;

// Page d’accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Vue login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Vue register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Vue prestations
Route::get('/prestations', function () {
    return view('prestations');
})->name('prestations');

// Dashboard utilisateur
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])->middleware('auth')->name('dashboard.messages');

// Coordonnées (admin et utilisateur)
Route::get('/dashboard/coordonnes', [DashboardController::class, 'coordonnees'])->name('dashboard.coordonnes');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Messages reçus côté admin
    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/user/{id}', [AdminController::class, 'showUser'])->name('admin.dashboard.user');
});

Route::post('/devis/send', [DevisController::class, 'sendDevisEmail'])->name('devis.send');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
