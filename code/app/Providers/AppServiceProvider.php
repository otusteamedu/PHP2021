<?php

namespace App\Providers;

use App\Interfaces\NoSqlRepositoryInterface;
use App\Repositories\MongoDB;
use App\Repositories\Redis;
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
        $nosqlRep = strtolower(config('nosql.name'));
        if ($nosqlRep == 'redis') {
            $this->app->bind(NoSqlRepositoryInterface::class, Redis::class);
        } elseif ($nosqlRep == 'mongodb') {
            $this->app->bind(NoSqlRepositoryInterface::class, MongoDB::class);
        }

    }
}
