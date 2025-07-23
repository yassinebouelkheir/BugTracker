<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index() {
        return Issue::with('creator')->get();
    }

    public function show(Issue $issue) {
        return $issue->load('creator');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'titre' => 'required|string',
            'description' => 'nullable|string',
            'priority' => 'nullable|integer',
            'state' => 'nullable|string',
            'creator_id' => 'required|exists:users,id'
        ]);
        return Issue::create($data);
    }

    public function update(Request $request, Issue $issue) {
        $issue->update($request->only(['titre', 'description', 'priority', 'state']));
        return $issue;
    }

    public function destroy(Issue $issue) {
        $issue->delete();
        return response()->noContent();
    }

    public function destroyAll() {
        Issue::truncate();
        return response()->json(['message' => 'All issues deleted']);
    }
}
