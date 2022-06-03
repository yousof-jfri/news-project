<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'image',
        'public',
        'views',
        'user_id',
        'slug'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
