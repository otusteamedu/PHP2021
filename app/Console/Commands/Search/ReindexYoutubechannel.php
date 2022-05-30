<?php

namespace App\Console\Commands\Search;

use App\Models\Youtubechannel;
use App\Observers\YoutubechannelsObserver;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexYoutubechannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex:youtubechannels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all youtubechannels to Elasticsearch';
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
        $this->info('Indexing all youtubechannels. This might take a while...');
        $observer = new YoutubechannelsObserver($this->elasticsearch);
        $observer->reindex();
        $this->info('\\nDone!');
    }
}
