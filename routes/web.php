<?php

use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Contact;

// Contrôleurs
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoordonneesController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::get('/simulate-admin', function () {
    $user = \App\Models\User::where('email', 'pierrard@test.fr')->first();

    if (!$user) {
        abort(404, 'Utilisateur non trouvé.');
    }

    Auth::login($user); // Simule la connexion

    return redirect()->route('admin.dashboard_admin');
});



Route::middleware(['auth'])->group(function () {
   
});


Route::get('/user/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'role:user'])
    ->name('admin.dashboard_userr');
Route::get('/', fn() => view('welcome'))->name('home');    

// 🔐 Authentification
require __DIR__.'/auth.php';
Route::get('/login', fn() => view('auth.login'))->name('login');

    // Tableau de bord admin
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard_admin');

    // Vue utilisateur ciblée sur lui-même
    Route::get('/user/dashboard/{id}', [DashboardController::class, 'userDashboard'])->name('admin.dashboard_user');
    

     // Vue partagée des coordonnées
    Route::get('/dashboard/coordonnees', [DashboardController::class, 'coordonnees'])->name('dashboard.coordonnees');

// Messages côté utilisateur
Route::get('/mes-messages', [ContactController::class, 'userMessages'])->middleware('auth')->name('contact.user');

// Messages côté admin
Route::get('/admin/messages', [ContactController::class, 'adminMessages'])->middleware(['auth', 'isAdmin'])->name('contact.admin');

 // 👈 fermeture correcte ici
// 💼 Prestations
Route::get('/prestations', fn() => view('prestations'))->name('prestations');

// 🧪 Vérification d’un admin spécifique
Route::get('/check-admin', function () {
    $user = User::where('email', 'lexpertimmo06@gmail.com')->first();
    return $user
        ? response()->json(['name' => $user->name, 'email' => $user->email, 'role' => $user->role])
        : response()->json(['error' => 'Utilisateur non trouvé.']);
});


Route::get('/contact', [ContactController::class, 'contactForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');


// 📄 Devis
Route::post('/devis/send', [DevisController::class, 'sendDevisEmail'])->name('devis.send');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])->name('dashboard.user');
    Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])->name('dashboard.messages');
    Route::get('/coordonnees', [CoordonneesController::class, 'edit'])->name('coordonnees.form');
    Route::post('/coordonnees', [CoordonneesController::class, 'update'])->name('coordonnees.update');
    Route::post('/coordonnees/store', [CoordonneesController::class, 'store'])->name('coordonnees.store');
    Route::get('/coordonnees/show', [CoordonneesController::class, 'show'])->name('coordonnees.show');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard_admin');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Utilisateurs
    Route::get('/dashboard/user', [AdminController::class, 'index'])->name('dashboard_user_form');
    Route::get('/dashboard/user/list', [AdminController::class, 'index'])->name('dashboard_user_list');
    Route::get('/dashboard/user/{id}', [AdminController::class, 'showUser'])->name('dashboard_user_profile');
    Route::get('/dashboard/view/{id}', [DashboardController::class, 'showUserDashboard'])->name('dashboard.user');

    // Coordonnées
    Route::get('/coordonnees/{userId}', [CoordonneesController::class, 'showAdmin'])->name('coordonnees.admin');

    // Contacts
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact');

    // Messages
    Route::get('/messages', [AdminContactController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [AdminContactController::class, 'show'])->name('messages.show');
    Route::get('/messages/{id}/reply', [AdminContactController::class, 'reply'])->name('messages.reply');
    Route::delete('/messages/{id}', [AdminContactController::class, 'destroy'])->name('messages.destroy');
});