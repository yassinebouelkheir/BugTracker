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

    public function store(Request $request)
    {
        $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        Comment::create([
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back();
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
