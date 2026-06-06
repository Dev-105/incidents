<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }


    public function edit(Comment $comment)
    {
        $this->authorizeCommentOwner($comment);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorizeCommentOwner($comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        $this->authorizeCommentOwner($comment);

        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)->with('success', 'Comment deleted successfully.');
    }

    /**
     * Check that the current user owns the comment.
     */
    protected function authorizeCommentOwner(Comment $comment): void
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
