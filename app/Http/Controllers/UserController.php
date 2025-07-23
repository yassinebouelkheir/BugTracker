<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return User::with(['team', 'projets', 'comments'])->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email|unique:users',
            'mdp' => 'required|string|min:6',
            'role' => 'sometimes|string',
            'team_id' => 'nullable|exists:teams,id'
        ]);
        
        $data['role'] = $data['role'] ?? 'user';
        $data['mdp'] = Hash::make($data['mdp']);

        return User::create($data);
    }

    public function show(User $user) {
    return $user->load(['team', 'projets', 'comments']);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|string',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }


    public function destroy(User $user) {
        $user->delete();
        return response()->noContent();
    }
}
