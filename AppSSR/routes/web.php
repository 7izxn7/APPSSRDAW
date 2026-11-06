<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas del perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de proyectos
Route::middleware(['auth'])->group(function () {

    Route::resource('projects', ProjectController::class);

    // Añadir participantes a un proyecto
    Route::post('/projects/{project}/participants',
        [ProjectController::class, 'addParticipant']
    )->name('projects.participants.store');

    Route::put(
    '/projects/{project}/participants/{participant}',
        [ProjectController::class, 'updateParticipant']
    )->name('projects.participants.update');
});

require __DIR__.'/auth.php';