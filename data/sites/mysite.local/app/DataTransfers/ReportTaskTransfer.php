<?php

declare(strict_types=1);

namespace App\DataTransfers;

use App\Contracts\Constants\ReportStatusesConstants;
use JetBrains\PhpStorm\Pure;

/**
 * Class ReportTaskTransfer
 * @package mysite\app\DataTransfers
 */
class ReportTaskTransfer
{

    /**
     * ReportTaskTransfer constructor.
     * @param int $report_type_id
     * @param string $destination
     * @param int $status
     */
    public function __construct(
        private int $report_type_id,
        private string $destination,
        private int $status
    ) {
    }

    /**
     * @param array $data
     * @return ReportTaskTransfer
     */
    #[Pure] public static function createFromArray(array $data): ReportTaskTransfer
    {
        return new self(
            (int) $data['report_type_id'],
            (string) $data['destination'],
            ReportStatusesConstants::ACCEPTED
        );
    }

    /**
     * @return int
     */
    public function getReportTypeId(): int
    {
        return $this->report_type_id;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }


}
