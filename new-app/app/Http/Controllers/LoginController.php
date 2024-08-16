<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->onlyInput('login');
        }

        // Récupération des informations de connexion
        $login = $request->input('login');
        $password = $request->input('password');

        // Tentative de connexion avec email ou téléphone
        $credentials = filter_var($login, FILTER_VALIDATE_EMAIL) ? ['email' => $login] : ['phone' => $login];
        $credentials['password'] = $password;

        if (Auth::attempt($credentials)) {
            // Connexion réussie, redirection vers la page d'accueil
            return redirect()->intended('image')->with('success', 'You are logged in!');
        }

        // Connexion échouée, redirection avec message d'erreur
        return redirect()->back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }
}
