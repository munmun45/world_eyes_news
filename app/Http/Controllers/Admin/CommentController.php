<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with('article')->latest();

        if ($request->filled('status')) {
            $isApproved = $request->status === 'approved';
            $query->where('is_approved', $isApproved);
        }

        $comments = $query->paginate(15)->withQueryString();

        return view('admin.comments.index', compact('comments'));
    }

    public function toggleApprove($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = !$comment->is_approved;
        $comment->save();

        return back()->with('success', 'Comment status has been updated.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
