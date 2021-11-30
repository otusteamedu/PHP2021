<?php

namespace App\Console\Commands;

use App\Models\Channel;
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
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    /** @var \Elasticsearch\Client */
    private $elasticsearch;

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        foreach (Channel::cursor() as $channel)
        {
            $this->elasticsearch->index([
                'index' => $channel->getSearchIndex(),
                'type' => $channel->getSearchType(),
                'id' => $channel->getKey(),
                'body' => $channel->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        foreach (Video::cursor() as $video)
        {
            $this->elasticsearch->index([
                'index' => $video->getSearchIndex(),
                'type' => $video->getSearchType(),
                'id' => $video->getKey(),
                'body' => $video->toSearchArray(),
            ]);

            $this->output->write('.');
        }


        $this->info('\nDone!');
    }
}