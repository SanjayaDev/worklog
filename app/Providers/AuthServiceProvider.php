<?php

namespace App\Providers;

use App\Models\ModuleRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
    public function boot()
    {
        $this->registerPolicies();

        // Gate for dynamic authorization
        Gate::define("check-module", function($user, $module_code) {

            // If user not super admin
            if ($user->role_id > 1) {

                // Check what's user role allow access this module
                $check_exists = ModuleRole::whereHas("module", function($query) use ($module_code) {
                                    $query->where("module_code", $module_code);
                                })->whereHas("role", function($query) use ($user) {
                                    $query->where("role_id", $user->role_id);
                                })
                                ->exists();

                // return $check_exists;
                return $check_exists;
            } 

            // If user a super admin
            return TRUE;
        });
    }
}
