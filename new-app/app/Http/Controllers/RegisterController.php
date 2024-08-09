<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Utilisez le nom correct du modèle, en majuscule

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' =>Hash::make($request->password),
        ]);

        // Redirection ou message de succès
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}
