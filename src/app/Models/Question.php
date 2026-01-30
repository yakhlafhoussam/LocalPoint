<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'post';

    protected $fillable = [
        'title',
        'content',
        'city',
        'user_id',
        'created_at'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'post_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
