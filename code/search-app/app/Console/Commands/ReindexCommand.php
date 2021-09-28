<?php

namespace App\Console\Commands;

use App\Services\Youtube\Repositories\Background\ElasticsearchVideos;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:videos:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all videos to Elasticsearch';

    private ElasticsearchVideos $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ElasticsearchVideos $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Indexing all videos. This might take a while...');

        $numberofVideos = $this->service->reindexAllVideos();

        $this->info(PHP_EOL . $numberofVideos . ' added to index.');
        $this->info(PHP_EOL . 'Done!');
    }
}
