<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class News extends Model
{
    use HasFactory;

    public $table = 'newses'; 

    protected $fillable = [
        'title',
        'description',
        'body',
        'image',
        'public',
        'is_supernews',
        'views',
        'user_id',
        'category_id',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
