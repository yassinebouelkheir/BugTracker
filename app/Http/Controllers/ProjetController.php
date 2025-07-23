<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index() {
        return Projet::with(['users', 'team'])->get();
    }

    public function show(Projet $projet) {
        return $projet->load(['users', 'team']);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'date_assignation' => 'nullable|date',
            'avancement' => 'nullable|integer',
            'priority' => 'nullable|integer',
            'team_id' => 'nullable|exists:teams,id'
        ]);
        return Projet::create($data);
    }

    public function update(Request $request, Projet $projet) {
        $projet->update($request->only([
            'nom', 'description', 'date_assignation', 'avancement', 'priority', 'team_id'
        ]));
        return $projet;
    }

    public function destroy(Projet $projet) {
        $projet->delete();
        return response()->noContent();
    }

    public function destroyAll() {
        Projet::truncate();
        return response()->json(['message' => 'All projets deleted']);
    }
}
