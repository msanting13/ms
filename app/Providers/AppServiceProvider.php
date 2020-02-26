<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use App\Role;
use App\Card;

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
            'auth.register',
            'users.user-dashboard',
            'director.director-dashboards',
            //'admin.manage-users'
        ], 
        function($view){
            $view->with('totalnumbersOfActiveReportsForResearch',Card::where('is_lock', FALSE)->where('type','research')->count());
            $view->with('totalnumbersOfActiveReportsForExtension',Card::where('is_lock', FALSE)->where('type','extension')->count());
            $view->with('totalnumbersOfLockedReportsForResearch',Card::where('is_lock', TRUE)->where('type','research')->count());
            $view->with('totalnumbersOfLockedReportsForExtension',Card::where('is_lock', TRUE)->where('type','extension')->count());
            $view->with('roles',Role::get());
        });

        Relation::morphMap([
            'Research'      =>      'App\ResearchCard'
            // 'Extension'     =>      'App\PurchaseRequest'
        ]);
    }
}
