<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Fields we allow to be filled from form input.
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
        'latitude',
        'longitude',
    ];

    // A post belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post belongs to a category.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A post can have many comments.
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
