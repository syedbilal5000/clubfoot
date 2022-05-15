<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Check for Admin
        // Return true, if auth user role is admin
        $gate->define('isAdmin', function($user) {
            return $user->role_id == 1;
        });

        // Check for Moderator
        // Return true, if auth user role is moderator
        $gate->define('isModerator', function($user) {
            return $user->role_id == 2;
        });

        // Check for Viewer
        // Return true, if auth user role is viewer
        $gate->define('isViewer', function($user) {
            return $user->role_id == 3;
        });
    }
}
