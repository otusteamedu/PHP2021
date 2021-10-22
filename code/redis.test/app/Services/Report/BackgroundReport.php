<?php

declare(strict_types=1);

namespace App\Services\Report;

use App\Dto\ApiAnswerDTO;
use App\Jobs\ReportJob;
use App\Services\Report;
use Illuminate\Contracts\Bus\Dispatcher;

final class BackgroundReport implements Report
{

    private const SUCCESS_MESSAGE = "Запрос на отчет принят.";

    private const ERROR_MESSAGE = "Ошибка запроса!";

    public function __construct(private ReportJob $job)
    {
    }

    /**
     * @param array $data
     * @return ApiAnswerDTO
     */
    public function request(array $data): ApiAnswerDTO
    {
        $this->job->setData($data);

        try {
            app(Dispatcher::class)->dispatch($this->job);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
            return new ApiAnswerDTO(false, self::ERROR_MESSAGE);
        }

        return new ApiAnswerDTO(true,self::SUCCESS_MESSAGE);
    }
}
