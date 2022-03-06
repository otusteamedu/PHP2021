<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\CreateRequestDTO;

interface ReportRequest
{

    /**
     * @param CreateRequestDTO $createReportRequestDTO
     * @return string|null
     */
    public function create(CreateRequestDTO $createReportRequestDTO): ?string;

    /**
     * @param string $messageId
     * @return string
     */
    public function getStatus(string $messageId): string;

    /**
     * @param string $messageId
     * @param string $data
     * @return bool
     */
    public function process(string $messageId, string $data = ''): bool;

    /**
     * @param string $messageId
     * @return string
     */
    public function getData(string $messageId): string;

}
