<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;


class Blog extends Model
{
    use HasFactory;

    const IS_PUBLIC = [
        'private' => 0,
        'public' => 1,
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'No User'
        ]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeOnlyPublic($query)
    {
        
        return $query->where('is_public', Blog::IS_PUBLIC['public']);
    }
}
