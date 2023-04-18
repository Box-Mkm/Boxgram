<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    use HasFactory;
    public function post():BelongsTo
    {
        return $this->belongsto(Post::class);
    }
    public function owner():BelongsTo
    {
        return $this->belongsTo(related: User::class , foreignKey: 'user_id');
    }
}
