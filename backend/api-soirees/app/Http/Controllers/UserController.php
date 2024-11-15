<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        return User::all();
    }

    // Créer un utilisateur
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'region' => 'nullable|string',
                'city' => 'nullable|string',
                'age' => 'nullable|integer',
                'interests' => 'nullable|array',
                'rating' => 'nullable|numeric'
            ]);

            $user = User::create($validatedData);
            
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // Afficher un utilisateur par ID
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'age' => 'nullable|integer',
            'interests' => 'nullable|array',
            'rating' => 'nullable|numeric'
        ]);

        $user->update($validatedData);

        return response()->json($user);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
