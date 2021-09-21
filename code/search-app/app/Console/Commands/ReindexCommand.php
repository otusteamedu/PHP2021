<?php

namespace App\Console\Commands;

use App\Models\Video;
use Elasticsearch\Client;
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

    private Client $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Indexing all videos. This might take a while...');

        foreach (Video::cursor() as $video) {

            $this->elasticsearch->index([
                'index' => $video->getSearchIndex(),
                'type' => $video->getSearchType(),
                'id' => $video->getKey(),
                'body' => $video->toSearchArray(),
            ]);

            $this->output->write('.');

        }

        $this->info(PHP_EOL . 'Done!');
    }
}
