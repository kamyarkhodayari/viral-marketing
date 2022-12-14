<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User'       => 'App\Policies\UserPolicy',
        'App\Models\Product'    => 'App\Policies\ProductPolicy',
        'App\Models\Share'      => 'App\Policies\SharePolicy',
        'App\Models\Purchase'   => 'App\Policies\PurchasePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
