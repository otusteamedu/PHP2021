<?php

namespace App\Providers;

use App\Jobs\ImportEmailJob;
use App\Jobs\ImportEmailJobInterface;
use App\Jobs\ImportPolisJob;
use App\Jobs\ImportPolisJobInterface;
use App\Services\Parsing\AlfaInsuranceParsing;
use App\Services\Parsing\ParsingInterface;
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
        $this->app->bind(ImportPolisJobInterface::class, ImportPolisJob::class);
        $this->app->bind(ParsingInterface::class, AlfaInsuranceParsing::class);
        $this->app->bind(ImportEmailJobInterface::class, ImportEmailJob::class);
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
