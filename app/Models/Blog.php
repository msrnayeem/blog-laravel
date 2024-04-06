<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
        'publisher_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
}
