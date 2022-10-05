<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  use HasFactory;

  protected $fillable = ['body', 'approved', 'user_id', 'parent_id', 'commentable_id', 'commentable_type'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function commentable()
  {
    return $this->morphTo();
  }

  public function childs()
  {
    return $this->hasMany(Comment::class, 'parent_id', 'id');
  }
}
