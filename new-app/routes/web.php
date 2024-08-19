<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;

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
Route::get('/test', function () {
    return view('Test');
})->name('test');
Route::get('/gestion', function () {
    return view('Gestion');
})->name('gestion');


Route::get('/login', function () {
    return view('Login');
})->name('login');


// routes/web.php
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/Administration', function () {
    return view('user_management');
})->name('admin');


Route::get('/Acceuil', function () {
    return view('Acceuil');
})->name('Acceuil');


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');


Route::get('/test-db', function () {
    try {
        // Tentative de connexion à la base de données MySQL
        DB::connection()->getPdo();
        return 'Connexion MySQL réussie';
    } catch (\Exception $e) {
        // En cas d'échec de la connexion, afficher l'erreur
        return 'Échec de la connexion MySQL : ' . $e->getMessage();
    }
});


Route::get('/users', [UserController::class, 'list'])->name('users.list');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Optionnel: définir une route pour la page d'accueil si elle est utilisée
Route::get('/', function () {
    return redirect()->route('users.list');
});