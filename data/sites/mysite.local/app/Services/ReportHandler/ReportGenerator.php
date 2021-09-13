<?php

declare(strict_types=1);

namespace App\Services\ReportHandler;

/**
 * Class ReportGenerator
 * @package App\Services\ReportHandler
 */
class ReportGenerator
{

    /**
     * @return string
     */
    public function run(): string
    {
        sleep(10);
        return 'report';
    }
}
