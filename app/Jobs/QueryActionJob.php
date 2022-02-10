<?php

namespace App\Jobs;

use App\Models\Query;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueryActionJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    private $text;
    public $timestamps = false;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $query = new Query();
        $query->fill([
           'id' => $this->id,
           'text' => $this->text,
        ]);
        $query->save();
    }
}
