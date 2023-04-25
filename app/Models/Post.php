<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'slug','image','user_id'];
    public function owner(): BelongsTo
    {
        return $this->belongsTo(related: User::class,foreignKey: 'user_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class);
    }
}
