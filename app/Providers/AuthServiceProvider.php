<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;


use App\Models\User;
use App\View\Components\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Gate::define('edit-update-profile', fn (User $user, User $other) => $user->id === $other->id);
        Gate::define('edit-update-profile', fn (User $user, User $other) => $user->id === $other->id);
    }
}