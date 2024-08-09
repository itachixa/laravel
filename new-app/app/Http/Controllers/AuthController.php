<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('login'); // Assurez-vous que ce nom correspond à votre fichier Blade
    }

    // Méthode pour traiter la connexion
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Récupérer les données du formulaire
        $login = $request->input('login');
        $password = $request->input('password');

        // Déterminer si le champ est un email ou un téléphone
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Authentifier l'utilisateur
        if (Auth::attempt([$field => $login, 'password' => $password])) {
            // Rediriger vers la page d'accueil après une connexion réussie
            return redirect()->intended('/image')->with('success', 'You are logged in!');
        }

        // Rediriger vers la page de connexion avec un message d'erreur si l'authentification échoue
        return redirect()->back()->withErrors(['login' => 'The provided credentials do not match our records.'])->withInput();
    }
}
