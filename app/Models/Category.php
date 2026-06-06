<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Only the name and icon fields can be filled by the application.
    protected $fillable = [
        'name',
        'icon',
    ];

    // A category can have many posts.
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
