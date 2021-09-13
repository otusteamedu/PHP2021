<?php

declare(strict_types=1);

namespace App\Services\ReportTask;

use App\DataTransfers\ReportTaskResponse;
use App\DataTransfers\ReportTaskTransfer;
use App\Jobs\ReportTaskJob;
use App\Models\ReportTask;
use App\Repositories\ReportTaskRepository;
use Illuminate\Support\Facades\Queue;

/**
 * Class ReportTaskService
 * @package App\Services\ReportTask
 */
final class ReportTaskService
{

    /**
     * @param ReportTaskTransfer $reportTaskTransfer
     * @return int
     */
    public function store(ReportTaskTransfer $reportTaskTransfer): int
    {
        $reportTask = (new ReportTaskRepository())->store($reportTaskTransfer);

        if ($reportTask->id) {
            Queue::push(
                new ReportTaskJob($reportTask)
            );
        }

        return $reportTask->id;
    }

    /**
     * @param ReportTask $reportTask
     * @param int $status
     * @return bool
     */
    public function changeStatus(ReportTask $reportTask, int $status): bool
    {
        $reportTask->report_status_id = $status;
        return $reportTask->save();
    }

    /**
     * @param int $reportTaskId
     * @return ReportTask|null
     */
    public function getByReportTaskId(int $reportTaskId): ?ReportTask
    {
        return (new ReportTaskRepository())->getById($reportTaskId);
    }

}
