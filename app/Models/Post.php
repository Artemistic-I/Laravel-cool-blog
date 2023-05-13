<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->morphToMany('App\Models\User', 'interaction')
            ->wherePivot('status', 'like')
            ->withTimestamps();
    }

    public function dislikes()
    {
        return $this->morphToMany('App\Models\User', 'interaction')
            ->wherePivot('status', 'dislike')
            ->withTimestamps();
    }

    public function views()
    {
        return $this->morphToMany('App\Models\User', 'interaction')
            ->wherePivot('status', 'view')
            ->withTimestamps();
    }
}
