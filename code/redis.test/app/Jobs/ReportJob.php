<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\Calculate;
use App\Services\ReportRequest;
use App\Services\Sender;

final class ReportJob extends Job implements WithData
{

    private array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Calculate     $calculateService,
        private Sender        $senderService,
        private ReportRequest $reportRequestService
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->calculateService->calculate($this->data);

        $this->reportRequestService->process($this->job->getJobId(), json_encode($data));

        $sendResult = $this->senderService->send($data);

        echo "Report sent: " . $sendResult . PHP_EOL;
    }

    public function setData(array $array): void
    {
        $this->data = $array;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
