<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\Sender;
use App\Services\Calculate;

final class ReportJob extends Job implements WithData
{

    private array $data;

    public function __construct(
        private Calculate $calculateService,
        private Sender    $senderService
    )
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->calculateService->calculate($this->data);

        $sendResult = $this->senderService->send($data);

        echo "Report sent: " . $sendResult . PHP_EOL;
    }

    /**
     * @param array $array
     * @return mixed|void
     */
    public function setData(array $array)
    {
        $this->data = $array;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
