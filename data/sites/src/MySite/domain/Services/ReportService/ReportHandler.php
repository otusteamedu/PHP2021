<?php

declare(strict_types=1);

namespace MySite\domain\Services\ReportService;

/**
 * Class ReportHandler
 * @package MySite\domain\Services\ReportService
 */
class ReportHandler
{
    /**
     * @return string
     */
    public function getReport(): string
    {
        return $this->prepareReport();
    }

    /**
     * @return string
     */
    private function prepareReport(): string
    {
        sleep(10);
        return 'report';
    }
}
