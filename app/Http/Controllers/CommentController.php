<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        return Comment::with(['user', 'projet'])->get();
    }

    public function show(Comment $comment) {
        return $comment->load(['user', 'projet']);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'projet_id' => 'required|exists:projets,id'
        ]);
        return Comment::create($data);
    }

    public function update(Request $request, Comment $comment) {
        $comment->update($request->only(['content']));
        return $comment;
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return response()->noContent();
    }

    public function destroyAll() {
        Comment::truncate();
        return response()->json(['message' => 'All comments deleted']);
    }
}
