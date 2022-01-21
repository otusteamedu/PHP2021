<?php

namespace App\Providers;

use App\Service\AbstractFactory\AbstractFactoryInterface;
use App\Service\AbstractFactory\AbstractFoodFactory;
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
        $this->app->bind(AbstractFactoryInterface::class, AbstractFoodFactory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
