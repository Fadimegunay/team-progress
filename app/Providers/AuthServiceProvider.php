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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
		    if ($user->is_super_admin == 1) {
			    return true;
		    }
	    });
	    Gate::define('access', function ($user, ...$permissions) {
		    foreach ($permissions as $permission) {
			    if ($user->canAccess($permission)) {
				    return true;
			    }
		    }
		    return false;
	    });
    }
}
