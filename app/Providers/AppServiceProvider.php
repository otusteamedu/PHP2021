<?php

namespace App\Providers;

use App\Service\AbstractFactory\AbstractFactoryInterface;
use App\Service\AbstractFactory\AbstractFoodFactory;
use App\Service\Decorator\KetchupTopping;
use App\Service\Decorator\KetchupToppingInterface;
use App\Service\Observer\FoodObserver;
use App\Service\Observer\FoodObserverInterface;
use App\Service\Observer\Observer;
use App\Service\Observer\ObserverInterface;
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
        $this->app->bind(ObserverInterface::class, Observer::class);
        $this->app->bind(FoodObserverInterface::class, FoodObserver::class);
        $this->app->bind(KetchupToppingInterface::class, KetchupTopping::class);
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
