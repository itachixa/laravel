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

Route::post('/Administration', function () {
    return view('user_management');
})->name('admin');

// Routes pour la gestion des utilisateurs
Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update'); // Route PUT pour mise à jour
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Route DELETE pour suppression
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');

