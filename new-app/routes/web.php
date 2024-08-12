<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return "Bienvenue";
});

Route::get('/image', function () {
    return view('Home1_page');
});

Route::get('/home', function () {
    return view('Home');
});

Route::get('/register', function () {
    return view('Register');
})->name('register');

Route::get('/Administration', function () {
    return view('user_management');
})->name('admin');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Route pour stocker un nouvel utilisateur
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route pour afficher le formulaire de modification d'utilisateur
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Route pour mettre à jour un utilisateur existant
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Route pour supprimer un utilisateur
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route pour afficher la liste des utilisateurs
Route::get('/users', [UserController::class, 'list'])->name('users.list');

// Route pour rechercher des utilisateurs
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');