<?php

declare(strict_types=1);

namespace App\Services\ReportRequest;

use App\Dto\CreateRequestDTO;
use App\Models\Request;
use App\Services\ReportRequest;

final class ReportRequestEloquent implements ReportRequest
{

    /**
     * @param CreateRequestDTO $createReportRequestDTO
     * @return string|null
     */
    public function create(CreateRequestDTO $createReportRequestDTO): ?string
    {
        //Создаем сообщение в БД, куда потом ответ положим
        $reportRequest = new Request();
        $reportRequest->message_id = $createReportRequestDTO->getMessageId();
        $reportRequest->data = $createReportRequestDTO->getData();
        $reportRequest->status = $createReportRequestDTO->getStatus();
        $reportRequest->save();

        if ($reportRequest->isClean()) {
            return $reportRequest->message_id;
        }

        return null;
    }

    /**
     * @param string $messageId
     * @param string $data
     * @return bool
     */
    public function process(string $messageId, string $data = ''): bool
    {
        /** @var Request $reportRequest */
        $reportRequest = Request::where('message_id', $messageId)->firstOrFail();

        if (empty($data)) {
            $status = config('enums.message_status.ERROR');
        } else {
            $status = config('enums.message_status.DONE');
            $reportRequest->data = $data;
        }

        $reportRequest->status = $status;
        $reportRequest->save();

        return $reportRequest->isClean();
    }

    /**
     * @param string $messageId
     * @return string
     */
    public function getStatus(string $messageId): string
    {
        /** @var Request $reportRequest */
        $reportRequest = Request::where('message_id', $messageId)->firstOrFail();
        return $reportRequest->status;
    }

    /**
     * @param string $messageId
     * @return string
     */
    public function getData(string $messageId): string
    {
        /** @var Request $reportRequest */
        $reportRequest = Request::where('message_id', $messageId)->firstOrFail();
        return $reportRequest->data;
    }
}
