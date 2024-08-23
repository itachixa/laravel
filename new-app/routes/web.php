<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
    return view('users/profile');
})->name('Acceuil');

Route::get('/Acceuile', function () {
    return view('Acceuil');
})->name('Acceuile');

Route::get('/Home', function () {
    return view('Home');
})->name('Home');


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
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth');

// Optionnel: définir une route pour la page d'accueil si elle est utilisée
Route::get('/user/liste', function () {
    return redirect()->route('users.list');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/advice', function () {
        return view('advice');
    })->name('advice');

    Route::get('/services', function () {
        return view('services');
    })->name('services');
});
Route::get('/user/{id}', function($id) {
    $user = User::find($id);
    return response()->json($user);
});
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/advice', function () {
    return view('advice');
})->name('advice');

Route::get('/services', function () {
    return view('service');
})->name('services');

Route::get('/profile', function () {
    return view('user.profile');
})->name('user.profile');