<?php

declare(strict_types=1);

namespace App\Services\Report;

use App\Dto\ApiAnswerDTO;
use App\Dto\CreateRequestDTO;
use App\Jobs\ReportJob;
use App\Services\Report;
use App\Services\ReportRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\HttpFoundation\Response;


final class BackgroundReport implements Report
{

    private const ERROR_MESSAGE = "Ошибка запроса!";

    private const NOT_FOUND = "Неверный ID запроса";

    public function __construct(private ReportJob $job, private ReportRequest $reportRequestService)
    {
    }

    /**
     * @param array $data
     * @return ApiAnswerDTO
     */
    public function request(array $data): ApiAnswerDTO
    {
        $result = $this->addReportRequest($data);

        if (is_null($result)) {
            return new ApiAnswerDTO(false, self::ERROR_MESSAGE, Response::HTTP_BAD_REQUEST);
        }

        return new ApiAnswerDTO(true, $result);
    }

    /**
     * @param array $data
     * @return string|null
     */
    private function addReportRequest(array $data): ?string
    {
        $this->job->setData($data);

        try {
            //Помещаем сообщение в очередь
            $result = app(Dispatcher::class)->dispatch($this->job);

            //Помещаем запрос на отчет в хранилище, куда потом запишем ответ
            $createRequestDTO = new CreateRequestDTO((string)$result);
            $result = $this->reportRequestService->create($createRequestDTO);
            return $result;

        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param string $id
     * @return ApiAnswerDTO
     */
    public function getStatus(string $id): ApiAnswerDTO
    {
        try {
            $reportReqeustStatus = $this->reportRequestService->getStatus($id);
            return new ApiAnswerDTO(true, $reportReqeustStatus);
        } catch (\Exception $e) {
            return new ApiAnswerDTO(false, self::NOT_FOUND, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param string $id
     * @return ApiAnswerDTO
     */
    public function getData(string $id): ApiAnswerDTO
    {
        try {
            $reportReqeustData = $this->reportRequestService->getData($id);
            return new ApiAnswerDTO(true, json_decode($reportReqeustData, true));
        } catch (\Throwable $e) {
            return new ApiAnswerDTO(false, self::NOT_FOUND, Response::HTTP_NOT_FOUND);
        }
    }
}
