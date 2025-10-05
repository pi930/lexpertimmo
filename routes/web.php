<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DevisController;

Route::get('/', function () {
    return view('welcome');
});
// Affiche le formulaire
Route::get('/contact', function () {
    return view('contact');
});

// Traite le formulaire
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/test-db', function () {
    $sessions = DB::table('sessions')->get();
    return response()->json($sessions);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/messages', [ContactController::class, 'index'])->name('admin.messages');
});
Route::get('/devis/generer-apres-login', [DevisController::class, 'genererApresLogin'])->name('devis.genererApresLogin');

