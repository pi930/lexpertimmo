<?php
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\CoordonneesController;
use App\http\Controllers\RegisteredUserController;
use App\Http\Controllers\AdminContactController;

Route::get('/admin/contact', [AdminContactController::class, 'index'])
    ->middleware('auth')
    ->name('admin.contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/coordonnees', [CoordonneesController::class, 'edit'])->name('coordonnees.form');
    Route::post('/coordonnees', [CoordonneesController::class, 'update'])->name('coordonnees.update');
});
Route::get('/dashboard/coordonnees', [CoordonneesController::class, 'index'])->name('coordonnees.index');

// Page d’accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Vue login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Vue prestations
Route::get('/prestations', function () {
    return view('prestations');
})->name('prestations');

// Dashboard utilisateur

Route::get('/dashboard', function () {
    $messages = Contact::where('user_id', Auth::id())->latest()->get();
    return view('dashboard', compact('messages'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/messages', [ContactController::class, 'userMessages'])->middleware('auth')->name('dashboard.messages');

// Coordonnées (admin et utilisateur)
Route::get('/dashboard/coordonnes', [DashboardController::class, 'coordonnees'])->name('dashboard.coordonnes');

// Contact
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/admin/dashboard/user/{id}', [AdminController::class, 'showUser'])->name('admin.dashboard.user');
});
Route::get('/register', [RegisteredUserController::class, 'show'])->name('register');


Route::post('/devis/send', [DevisController::class, 'sendDevisEmail'])->name('devis.send');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
