<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',  // Vérifie que l'utilisateur existe
            'name' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|in:jeux de société,jeux vidéo,classique',
            'date_time' => 'required|date',
            'remaining_seats' => 'required|integer',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric'
        ]);

        $party = Party::create($validatedData);

        return response()->json([
            'message' => 'Soirée créée avec succès',
            'party' => $party
        ], 201);
    }

    // Récupérer toutes les soirées
    public function index()
    {
        $parties = Party::all();
        return response()->json($parties);
    }

    // Récupérer une soirée par son ID
    public function show($id)
    {
        $party = Party::findOrFail($id);
        return response()->json($party);
    }

    public function destroy($id)
    {
        $party = Party::findOrFail($id);  
        $party->delete();  

        return response()->json([
            'message' => 'Soirée supprimée avec succès'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $party = Party::findOrFail($id); 

        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|in:jeux de société,jeux vidéo,classique',
            'date_time' => 'required|date',
            'remaining_seats' => 'required|integer',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric'
        ]);

        
        $party->update($validatedData);

        return response()->json([
            'message' => 'Soirée mise à jour avec succès',
            'party' => $party
        ], 200);
    }
}
