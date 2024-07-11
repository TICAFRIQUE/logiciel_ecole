<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


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
        // view share variable
        $data_setting = Setting::first();
        $data_annee = AnneeScolaire::whereStatus('active')->first();

        view()->share([
            'data_setting' => $data_setting,
            'data_annee' => $data_annee,
        ]);


        Schema::defaultStringLength(191);
    }
}
