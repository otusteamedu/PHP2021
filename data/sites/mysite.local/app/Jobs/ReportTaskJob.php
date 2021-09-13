<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Contracts\Constants\ReportStatusesConstants;
use App\Models\ReportTask;
use App\Services\MessageSenderService\MessageSender;
use App\Services\ReportHandler\ReportGenerator;
use App\Services\ReportTask\ReportTaskService;
use JetBrains\PhpStorm\Pure;

/**
 * Class ReportTaskJob
 * @package App\Jobs
 */
class ReportTaskJob extends Job
{
    /**
     * @var ReportGenerator
     */
    private ReportGenerator $reportGenerator;

    /**
     * ReportTaskJob constructor.
     * @param ReportTask $reportTask
     */
    #[Pure] public function __construct(
        private ReportTask $reportTask
    ) {
        $this->reportGenerator = new ReportGenerator();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ReportTaskService())->changeStatus(
            $this->reportTask,
            ReportStatusesConstants::IN_PROGRESS
        );

        $sent = (new MessageSender())->send(
            $this->reportTask->destination,
            $this->reportGenerator->run()
        );

        (new ReportTaskService())->changeStatus(
            $this->reportTask,
            ($sent)
                ? ReportStatusesConstants::SENT
                : ReportStatusesConstants::FAILED
        );
    }
}
