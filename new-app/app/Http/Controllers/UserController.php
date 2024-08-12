<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all(); // Récupère tous les utilisateurs
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|confirmed|min:8',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'id' => 'required|exists:user,id',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = User::find($request->id);
        if ($user) {
            if ($request->name !== null) {
                $user->name = $request->name;
            }
            if ($request->phone !== null) {
                $user->phone = $request->phone;
            }
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
        }

        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        // Validation
        $request->validate([
            'id' => 'required|exists:user,id',
        ]);

        $user = User::find($request->id);
        if ($user) {
            $user->delete();
        }

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = $request->query;
        $users = User::where('name', 'LIKE', "%$query%")->get();
        return response()->json($users);
    }
}
