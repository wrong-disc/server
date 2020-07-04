<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-track', function ($user) {
            return $user->isAdmin() || $user->isEditor();
        });

        Gate::define('list-artist', function ($user) {
            return $user->isAdmin() || $user->isEditor();
        });

        Gate::define('delete-artist', function ($user) {
            return $user->isAdmin() || $user->isEditor();
        });
    }
}
