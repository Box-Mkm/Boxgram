<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'private_account',
        'username',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function suggested_users()
    {
        $following = auth()->user()->following()->wherePivot('confirmed', true)->get();
        return User::all()->diff($following)->except(auth()->id())->shuffle()->take(5);
    }
    public function likes()
    {
        return $this->belongsToMany(related: Post::class, table: 'likes');
    }
    public function following()
    {
        return $this->belongsToMany(related: User::class, table: 'follows', foreignPivotKey: 'user_id', relatedPivotKey: 'following_user_id')->withTimestamps()->withPivot('confirmed');
    }
    public function followers()
    {
        return $this->belongsToMany(related: User::class, table: 'follows', foreignPivotKey: 'following_user_id', relatedPivotKey: 'user_id')->withTimestamps()->withPivot('confirmed');
    }

    public function toggle_follow(User $user)
    {
        $this->following()->toggle($user);
        if (!$user->private_account) {
            $this->following()->updateExistingPivot($user, ['confirmed' => true]);
        }
    }
    public function follow(User $user)
    {
        if ($user->private_account) {
            return $this->following()->attach($user);
        };
        return $this->following()->attach($user, ['confirmed' => true]);
    }
    public function unfollow(User $user)
    {
        return $this->following()->detach($user);
    }
    public function is_pending(User $user)
    {
        return $this->following()->where(column: 'following_user_id', operator: $user->id)->where(column: 'confirmed', operator: false)->exists();
    }
    public function is_follower(User $user)
    {
        return $this->followers()->where(column: 'user_id', operator: $user->id)->where(column: 'confirmed', operator: true)->exists();
    }
    public function is_following(User $user)
    {
        return $this->following()->where(column: 'following_user_id', operator: $user->id)->where(column: 'confirmed', operator: true)->exists();
    }
}
