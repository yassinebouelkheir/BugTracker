<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required|string',
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
    public function userProjects()
    {
        $user = Auth::user();

        $projects = $user->projets()->with([
            'team',
            'users',     
            'comments.user', 
            'issues' => function ($query) {
                $query->with('creator', 'comments.user');
            },
            'improvements' => function ($query) {
                $query->with('creator', 'comments.user');
            }
        ])->get();


        return view('projets.index', compact('projects'));
    }
    public function showProjet($id)
    {
        $projet = Projet::with(['comments', 'issues', 'improvements'])->findOrFail($id);
        return view('projets.show', compact('projet'));
    }

}
