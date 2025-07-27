<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('blog')->get();
        return view('blogs.comment', ['comments' => $comments]);
    }

    public function store(Request $request, $blog)
    {
        $request->validate([
            'name' => 'required|max:100',
            'message' => 'required',
        ]);

        Comment::create([
            'commenter_name' => $request->name,
            'comment_text' => $request->message,
            'blog_id' => $blog,
        ]);

        return redirect()->route('blogs.detail', $blog)->with('success', 'Komentas Berhasil Diposting!');
    }

    public function destroy($comment)
    {
        $comment = Comment::findOrFail($comment)->delete();

        if (!$comment) {
            return redirect()->route('comment.index')->with('failed', 'Comment Failed to Delete!');
        }

        return redirect()->route('comment.index')->with('success', 'Comment Deleted Succesfully!');
    }
}
