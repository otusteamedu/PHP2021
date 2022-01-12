<?php

declare(strict_types=1);

namespace App\Providers;

use App\Modules\Event\Application\Contracts\EventRedisRepositoryInterface;
use App\Modules\Event\Application\Contracts\EventServiceInterface;
use App\Modules\Event\Application\Services\EventService;
use App\Modules\Event\Infrastructure\Repositories\RedisRepository;
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
        $this->app->bind(EventServiceInterface::class, EventService::class);
        $this->app->bind(EventRedisRepositoryInterface::class, RedisRepository::class);
    }
}
