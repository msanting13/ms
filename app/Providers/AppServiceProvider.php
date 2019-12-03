<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use App\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer([
            'auth.register'
        ], 
        function($view){
            $view->with('roles',Role::get());
            // $view->with('fiscalyears',['']);
        });

        Relation::morphMap([
            'Research'      =>      'App\ResearchCard'
            // 'Extension'     =>      'App\PurchaseRequest'
        ]);
    }
}
