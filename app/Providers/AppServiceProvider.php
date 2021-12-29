<?php

namespace App\Providers;

use App\Jobs\RestRequestInterface;
use App\Jobs\RestRequestJob;
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
        $this->app->Bind(RestRequestInterface::class, RestRequestJob::class);
    }
}
