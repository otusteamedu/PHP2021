<?php

declare(strict_types=1);

namespace Src;

use Exception;

class App
{
    private ResponseService $responseService;

    public function __construct()
    {
        $this->responseService = new ResponseService();
    }

    public function run(): void
    {
        try {
            if ($this->isEmptyParam()) {
                throw new Exception('String is empty');
            }

            $validatorBrackets = new ValidatorBrackets($_POST['string']);
            if (false === $validatorBrackets->validate()) {
                throw new Exception($validatorBrackets->getReason());
            }

            $this->responseService->sendOkResponse('Bracket correct');
        } catch (Exception $e) {
            $this->responseService->sendBadResponse($e->getMessage());
        }
    }

    private function isEmptyParam()
    {
        return empty($_POST['string']);
    }
}
