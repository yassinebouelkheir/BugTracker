<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index() {
        return Team::with(['users', 'projets'])->get();
    }

    public function show(Team $team) {
        return $team->load(['users', 'projets']);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nom' => 'required|string'
        ]);
        return Team::create($data);
    }

    public function update(Request $request, Team $team) {
        $team->update($request->only(['nom']));
        return $team;
    }

    public function destroy(Team $team) {
        $team->delete();
        return response()->noContent();
    }

    public function destroyAll() {
        Team::truncate();
        return response()->json(['message' => 'All teams deleted']);
    }
}
