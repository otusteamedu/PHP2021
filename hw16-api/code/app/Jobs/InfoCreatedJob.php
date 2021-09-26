<?php

namespace App\Jobs;

use App\Models\Info;
use App\Repositories\Info\InfoEloquentRepository;
use Illuminate\Support\Facades\Log;

class InfoCreatedJob extends Job
{
    private Info $info;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Info $info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $repository = new InfoEloquentRepository();
        $this->info = $repository->update($this->info,'created;logged');
        Log::info(json_encode($this->info));
    }
}
