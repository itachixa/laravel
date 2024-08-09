<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    // Affiche le formulaire
    public function showForm()
    {
        return view('form');
    }

    // Traite les données du formulaire
    public function handleForm(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Traiter les données (ex. enregistrer dans la base de données)
        // ...

        return redirect()->route('form.success'); // Redirection après traitement
    }
}
