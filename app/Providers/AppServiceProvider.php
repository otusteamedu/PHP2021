<?php

namespace App\Providers;

use App\Jobs\BankStatementInterface;
use App\Jobs\BankStatementJob;
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
        $this->app->bind(BankStatementInterface::class, BankStatementJob::class);

    }
}
