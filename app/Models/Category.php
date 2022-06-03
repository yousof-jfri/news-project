<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'en_name',
        'slug',
        'parent_id'
    ];

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
