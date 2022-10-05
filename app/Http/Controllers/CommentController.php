<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function add(Request $request)
  {
    $data = $request->validate([
      'commentable_id' => 'required',
      'commentable_type' => 'required',
      'body' => ['required', 'min:3'],
      'parent_id' => 'required'
    ]);

    auth()->user()->comments()->create($data);

    alert()->success('موفق', 'نظر شما با موفقیت ثبت شد و پس از تایید شدن در سایت قرار میگیرد.');
    return back();
  }
}
