<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransfers\ReportTaskTransfer;
use App\Models\ReportTask;

/**
 * Class ReportTaskRepository
 * @package App\Repositories
 */
final class ReportTaskRepository extends BaseRepository
{
    /**
     * @param ReportTaskTransfer $reportTaskTransfer
     * @return ReportTask
     */
    public function store(ReportTaskTransfer $reportTaskTransfer): ReportTask
    {
        /** @var ReportTask $reportTask */
        $reportTask = $this->startCondition();

        $reportTask->report_type_id = $reportTaskTransfer->getReportTypeId();
        $reportTask->destination = $reportTaskTransfer->getDestination();
        $reportTask->report_status_id = $reportTaskTransfer->getStatus();

        $reportTask->save();

        return $reportTask;
    }

    /**
     * @param int $reportTaskId
     * @return ReportTask|null
     */
    public function getById(int $reportTaskId): ?ReportTask
    {
        return
            $this
                ->startCondition()
                ->with('reportStatus:id,name')
                ->where('id', $reportTaskId)
                ->first();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return ReportTask::class;
    }
}
