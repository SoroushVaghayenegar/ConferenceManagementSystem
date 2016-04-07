<?php

namespace App\Providers;
use App\Conference;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('conf-manager-or-admin', function ($user, $conference) {
          // An admin can edit any conferences
          if ($user->is_admin)
            return true;

          // check to see if current user is a conference manage for this conference
          $managers = (array) $conference->managers()->find($user->id);

          return count($managers) > 0;
        });
    }
}
