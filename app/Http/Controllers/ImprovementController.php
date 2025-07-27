<?php

namespace App\Http\Controllers;

use App\Models\Improvement;
use Illuminate\Http\Request;

class ImprovementController extends Controller
{
    public function index() {
        return Improvement::with('creator')->get();
    }

    public function show(Improvement $improvement) {
        $improvement->load(['creator', 'comments']);
        return view('improvements.show', compact('improvement'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'titre' => 'required|string',
            'description' => 'nullable|string',
            'state' => 'nullable|string',
            'creator_id' => 'required|exists:users,id'
        ]);
        return Improvement::create($data);
    }

    public function update(Request $request, Improvement $improvement) {
        $improvement->update($request->only(['titre', 'description', 'state']));
        return $improvement;
    }

    public function destroy(Improvement $improvement) {
        $improvement->delete();
        return response()->noContent();
    }

    public function destroyAll() {
        Improvement::truncate();
        return response()->json(['message' => 'All improvements deleted']);
    }
}
