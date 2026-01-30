<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'comment';

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'created_at'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
