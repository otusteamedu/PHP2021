<?php

namespace App\Providers;

use App\Services\Events\Repositories\EventRepository;
use App\Services\Events\Repositories\Redis\RedisEventRepository;
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
        $this->app->bind(EventRepository::class, RedisEventRepository::class);
    }
}
