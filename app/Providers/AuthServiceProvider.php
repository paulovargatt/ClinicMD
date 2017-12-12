<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //SE É Tecnica quem esta acessando (TYPE = 1):
        Gate::define('accesso-movimentacoes', function ($user, $movimentacao){
            if ($user->type == 1 ){
                return true;
            }
            return false;
        });

        Gate::define('admin', function ($user){
            if ($user->type == 3 ){
                return true;
            }
            return false;
        });
    }
}
