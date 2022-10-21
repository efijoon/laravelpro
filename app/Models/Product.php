<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'desc', 'stock', 'views_count', 'image', 'price'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function comments()
  {
    return $this->morphMany(Comment::class, 'commentable');
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  public function attributes()
  {
    return $this->belongsToMany(Attribute::class)->withPivot(['value_id']);
  }
}
