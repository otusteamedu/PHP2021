<?php

namespace App\Providers;

use App\Services\Calculate;
use App\Services\Calculate\ReportCalculate;
use App\Services\Report;
use App\Services\Report\BackgroundReport;
use App\Services\Sender;
use App\Services\Sender\EmailReportSender;
use App\Services\View;
use App\Services\View\SimpleView;
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
        $this->app->bind(Report::class, BackgroundReport::class);
        $this->app->bind(View::class, SimpleView::class);
        $this->app->bind(Calculate::class, ReportCalculate::class);
        $this->app->bind(Sender::class, EmailReportSender::class);
    }
}
