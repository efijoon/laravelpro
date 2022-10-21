<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function index(Request $request)
  {
    $comments = Comment::query();

    if ($keyword = $request->search) {
      $comments
        ->where('body', 'LIKE', "%$keyword%")
        ->orWhereHas('user', function ($query) use ($keyword) {
          $query->where('name', 'LIKE', "%$keyword%");
        })
        ->orWhereHas('commentable', function ($query) use ($keyword) {
          $query->where('name', 'LIKE', "%$keyword%");
        });
    }

    $comments = $comments->paginate(20);

    return view('admin.comments.index', compact('comments'));
  }

  public function update(Request $request, Comment $comment)
  {
    $comment->update([
      'approved' => $request->approved ? 1 : 0
    ]);

    alert('موفق', 'نظر با موفقیت ویرایش شد.', 'success');
    return back();
  }

  public function destroy(Comment $comment)
  {
    $comment->delete();

    alert('موفق', 'نظر با موفقیت حذف شد.', 'success');
    return back();
  }
}
