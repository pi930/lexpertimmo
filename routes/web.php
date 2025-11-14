<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 📦 Models
use App\Models\User;
use App\Models\Prestation;
use App\Models\Devis;
use App\Models\Contact;

// 🎯 Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\IsAdminController;
use App\Http\Controllers\IsAdminContactController;
use App\Http\Controllers\IsAdmin\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoordonneesController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PrestationsController;
use App\Http\Controllers\UserController;


// 🏠 Accueil & Auth
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', fn() => view('auth.login'))->name('login');
require __DIR__.'/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/IsAdmin/dashboard/user/{id}/messages', [ContactController::class, 'showUserMessages'])->name('IsAdmin.dashboard.user.messages');
});
Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/IsAdmin/contact/reply/{id}', [ContactController::class, 'replyForm'])->name('IsAdmin.contact.reply');
    Route::post('/IsAdmin/contact/reply/{id}', [ContactController::class, 'sendReply'])->name('IsAdmin.contact.send');
});

 Route::get('/prestations-public', [PrestationsController::class, 'public'])->name('prestations.public');

// 🧪 Tests & utilitaires
Route::get('/session-test', fn() => session(['test' => 'ok']) && 'Session test enregistrée');
Route::post('/test-post', fn() => response()->json(['message' => 'Requête reçue']));
Route::get('/check-IsAdmin', function () {
    $user = User::where('email', 'lexpertimmo06@gmail.com')->first();
    return $user
        ? response()->json(['nom' => $user->name, 'email' => $user->email, 'role' => $user->role])
        : response()->json(['error' => 'Utilisateur non trouvé.']);
});

Route::get('/dashboard/user/{id}', [DashboardController::class, 'showUserDashboard'])
    ->middleware('auth')
    ->name('user.dashboard');

// 👤 Utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/contact/public', [ContactController::class, 'contactform'])->name('contact.public');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');   
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/contact/{id}', [ContactController::class, 'show'])->name('user.contact');
   
});

// Messages côté utilisateur connecté
Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])
    ->middleware('auth')
    ->name('user.messages');

// Messages côté IsAdmin
Route::get('/IsAdmin/dashboard/messages', [ContactController::class, 'IsAdminMessages'])
    ->middleware(['auth', 'IsAdmin']) // ou vérification manuelle dans le contrôleur
    ->name('IsAdmin.messages');
Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');


    // Coordonnées utilisateur
    Route::get('/coordonnees', [CoordonneesController::class, 'edit'])->name('coordonnees.form');
    Route::post('/coordonnees', [CoordonneesController::class, 'update'])->name('coordonnees.update');
    Route::post('/coordonnees/store', [CoordonneesController::class, 'store'])->name('coordonnees.store');
    Route::get('/coordonnees/show', [CoordonneesController::class, 'show'])->name('coordonnees.show');

    // Coordonnées partagées
    Route::get('/dashboard/coordonnees', [DashboardController::class, 'coordonnees'])->name('dashboard.coordonnees');

    // Messages utilisateur
    Route::get('/contact/{id}', [ContactController::class, 'show'])->name('user.contact');
    Route::get('/contact/form', [ContactController::class, 'contactForm'])->name('contact.form');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store.secondary');
    Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])->name('dashboard.messages');


    // Prestations
    Route::get('/prestations', fn() => view('prestations', ['prestations' => Prestation::all()]))->name('prestations');
    Route::get('/prestations/{id}', [PrestationsController::class, 'show'])->name('user.prestations');
    Route::post('/prestations/selectionner', [PrestationsController::class, 'selectionner'])->name('prestations.selectionner');

    // Devis
    Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{id}', [DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{id}', [DevisController::class, 'destroy'])->name('devis.destroy');
    Route::post('/devis/send', [DevisController::class, 'sendDevisEmail'])->name('devis.send');
    Route::post('/devis/generer', [DevisController::class, 'generer'])->name('devis.generer');
    Route::post('/devis/calculer', [DevisController::class, 'calculer'])->name('devis.calculer');

// 🛡️ IsAdmin
Route::middleware(['auth', 'IsAdmin'])->prefix('IsAdmin')->name('IsAdmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'IsAdminDashboard'])->name('dashboard_IsAdmin');
    Route::get('/coordonnees/{userId}', [CoordonneesController::class, 'showIsAdmin'])->name('coordonnees.IsAdmin');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Contacts & messages
    Route::get('/contact', [IsAdminContactController::class, 'index'])->name('contact.index');
    Route::get('/messages', [IsAdminContactController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [IsAdminContactController::class, 'show'])->name('messages.show');
    Route::get('/messages/{id}/reply', [IsAdminContactController::class, 'reply'])->name('messages.reply');
    Route::delete('/messages/{id}', [IsAdminContactController::class, 'destroy'])->name('messages.destroy');
});

// 🔒 IsAdmin dashboard (doublon nettoyé)
Route::middleware(['auth', 'IsAdmin'])->get('/IsAdmin/messages', [ContactController::class, 'IsAdminMessages'])->name('contact.IsAdmin');