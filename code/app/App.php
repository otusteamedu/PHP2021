<?php declare(strict_types=1);

namespace App;

use App\Constants\CliCommands;
use App\Services\ResponseService;
use App\Services\ValidateRequestService;

class App
{
    private array $postParams;
    private ResponseService $responseService;

    public function __construct()
    {
        $this->postParams = $_POST;
        $this->responseService = new ResponseService();
    }

    public function handle()
    {
        $validateService = new ValidateRequestService($this->postParams['string']);

        $isValid = empty($this->postParams['deep_validate'])
            ? $validateService->isValid()
            : $validateService->isBalance($this->postParams['string']);

        $isValid
            ? $this->responseService->success()
            : $this->responseService->isNotValidateData();
    }

    public function isNotEmptyParams()
    {
        return !empty($this->postParams['string']);
    }
}