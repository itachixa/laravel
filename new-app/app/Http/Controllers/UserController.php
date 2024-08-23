<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function list()
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.list')->with('success', 'User added successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $request->id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|confirmed|min:6',
        ]);
    
        $user = User::find($request->id);
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
    
        return redirect()->route('Acceuil')->with('success', 'User updated successfully');
    }    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.list')->with('success', 'User deleted successfully');
    }
    public function edit($id)
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        return view('users.edit', compact('user'));
    }
public function profile()
{
    return view('users.profile');
}


}
