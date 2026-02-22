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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoordonneesController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PrestationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RendezvousController;





// 🏠 Accueil & Auth
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', fn() => view('auth.login'))->name('login');
require __DIR__.'/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::get('/messages/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/messages/{id}', [ContactController::class, 'update'])->name('messages.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/contact/reply/{id}', [ContactController::class, 'replyForm'])->name('messages.reply');
    Route::post('/admin/contact/reply/{id}', [ContactController::class, 'sendReply'])->name('send.reply');
});

 Route::get('/prestations-public', [PrestationsController::class, 'public'])->name('prestations.public');

// 🧪 Tests & utilitaires
Route::get('/session-test', fn() => session(['test' => 'ok']) && 'Session test enregistrée');
Route::post('/test-post', fn() => response()->json(['message' => 'Requête reçue']));
Route::get('/check-Admin', function () {
    $user = User::where('email', 'lexpertimmo06@gmail.com')->first();
    return $user
        ? response()->json(['nom' => $user->name, 'email' => $user->email, 'role' => $user->role])
        : response()->json(['error' => 'Utilisateur non trouvé.']);
});

Route::get('/dashboard/user/{id}', [DashboardController::class, 'showUserDashboard'])
    ->middleware('auth')
     ->name('user.dashboard.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');    

// 👤 Utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/contact/public', [ContactController::class, 'contactform'])->name('contact.public');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');   
    Route::get('/user/{id}/contact', [ContactController::class, 'show'])->name('show.user.contact');
    Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('messages.destroy');
});
Route::post('/user/find', [UserController::class, 'findUser'])->name('user.find');

Route::get('/user/{id}/dashboard', [UserController::class, 'dashboardUser'])
    ->name('user.dashboard');

// Messages côté utilisateur connecté
Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])
    ->middleware('auth')
    ->name('user.messages');

// Messages côté Admin
Route::get('/admin/dashboard/messages', [ContactController::class, 'AdminMessages'])
    ->middleware(['auth', 'admin']) // ou vérification manuelle dans le contrôleur
    ->name('admin.messages');
    Route::get('/dashboard', [DashboardController::class, 'dashboardRoute'])
    ->middleware('auth')
    ->name('admin.dashboard');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard-main');
});
// Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'AdminDashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');

// Dashboard Utilisateur
Route::get('/user/{id}/dashboard', [DashboardController::class, 'showUserDashboard'])
    ->middleware('auth')
    ->name('user.dashboard');


    // Coordonnées utilisateur
   Route::get('/coordonnees/form', [CoordonneesController::class, 'edit'])
    ->name('coordonnees.form');
    Route::post('/coordonnees', [CoordonneesController::class, 'store'])->name('coordonnees.store');
    Route::put('/coordonnees/{id}', [CoordonneesController::class, 'update'])->name('coordonnees.update');
    Route::get('/coordonnees/show', [CoordonneesController::class, 'show'])->name('coordonnees.show');

    // Coordonnées partagées
    Route::get('/dashboard/coordonnees', [DashboardController::class, 'coordonnees'])->name('dashboard.coordonnees');

    // Messages utilisateur

//    Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('Admin.dashboard_user');
//    })->name('dashboard');
//});
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  
   
  
Route::get('/user/contact/{id}', [ContactController::class, 'showUserMessages'])->name('user.contact');

    // Prestations
    Route::get('/prestations', fn() => view('prestations', ['prestations' => Prestation::all()]))->name('prestations');
    Route::get('/prestations/{id}', [PrestationsController::class, 'show'])->name('user.prestations');
    Route::post('/prestations/selectionner', [PrestationsController::class, 'selectionner'])->name('prestations.selectionner');

    // Devis
    Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{id}', [DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{id}', [DevisController::class, 'destroy'])->name('devis.destroy');
    Route::post('/devis/send', [DevisController::class, 'sendDevisEmail'])->name('devis.send');
  Route::get('/devis/formulaire', function () {
    return view('devis.formulaire');
})->name('devis.formulaire');
    Route::post('/devis/generer', [DevisController::class, 'generer'])->name('devis.generer');
    Route::post('/devis/calculer', [DevisController::class, 'calculer'])->name('devis.calculer');
    

// 🛡️ Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
   Route::get('/dashboard/admin', [DashboardController::class, 'AdminDashboard'])
    ->name('Admin.dashboard_Admin');
});
Route::get('/coordonnees/{userId}', [CoordonneesController::class, 'showAdmin'])
    ->name('coordonnees');

    // Notifications

Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard utilisateur
        Route::get('/dashboard/{id}', [DashboardController::class, 'dashboardUser'])
            ->name('dashboard_user');

    });


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    });
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/devis/download/{id}', [DevisController::class, 'download'])
    ->name('devis.download')
    ->middleware('auth');


    // Contacts & messages
    Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/messages', [AdminContactController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [AdminContactController::class, 'show'])->name('messages.show');
   // Route::get('/messages/{id}/reply', [AdminContactController::class, 'reply'])->name('messages.reply');
    });
   
    Route::delete('/messages/{id}', [AdminContactController::class, 'destroy'])->name('messages.destroy');


// =========================
// Routes Utilisateur
// ==============
     

    // Afficher les propositions ou le rendez-vous bloqué
Route::middleware(['auth'])->group(function () {

    // Route principale du dashboard rendez-vous
    Route::get('/user/rendezvous', [RendezvousController::class, 'indexUser'])
        ->name('user.rendezvous');

    // Route pour afficher les propositions après clic sur "Prendre rendez-vous"
    Route::get('/user/rendezvous/propositions', [RendezvousController::class, 'propositions'])
        ->name('user.rendezvous.propositions');

    // Réserver un rendez-vous (sélection parmi les 3 propositions)
  Route::post('user/rendezvous/reserver', [RendezvousController::class, 'reserver'])
     ->name('rendezvous.reserver');

});



    // Supprimer un rendez-vous bloqué (libérer le créneau)
 // routes/web.php
Route::delete('/rendezvous/{id}/supprimer', [RendezvousController::class, 'supprimer'])
    ->name('rendezvous.supprimer')
    ->middleware(['auth']);


// =========================
// Routes Admin
// =========================

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/rendezvous', [RendezvousController::class, 'indexAdmin'])
        ->name('admin.rendezvous');

    Route::get('/admin/rendezvous/{id}/edit', [RendezvousController::class, 'edit'])
        ->name('admin.rendezvous.edit');

    Route::put('/admin/rendezvous/{id}', [RendezvousController::class, 'updateAdmin'])
        ->name('admin.rendezvous.update');
});

