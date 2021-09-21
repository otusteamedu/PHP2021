<?php

namespace App\Providers;

use App\Services\Youtube\Repositories\Statistics\ChannelStatistics;
use App\Services\Youtube\Repositories\Statistics\Elasticsearch\ElasticsearchChannelStatistics;
use App\Services\Youtube\Repositories\Statistics\Elasticsearch\ElasticsearchTopStatistics;
use App\Services\Youtube\Repositories\Statistics\Relational\RelationalChannelStatistics;
use App\Services\Youtube\Repositories\Statistics\Relational\RelationalTopStatistics;
use App\Services\Youtube\Repositories\Statistics\TopStatistics;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
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

        if (!config('services.search.enabled')) {
            $this->app->bind(ChannelStatistics::class, RelationalChannelStatistics::class);
            $this->app->bind(TopStatistics::class, RelationalTopStatistics::class);
        } else {
            $this->app->bind(ChannelStatistics::class, function () {
                return new ElasticsearchChannelStatistics($this->app->make(Client::class));
            });
            $this->app->bind(TopStatistics::class, function () {
                return new ElasticsearchTopStatistics($this->app->make(Client::class));
            });
            $this->bindSearchClient();
        }
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
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
