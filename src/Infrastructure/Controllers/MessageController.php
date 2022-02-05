<?php

namespace App\Infrastructure\Controllers;


use App\Application\Services\CodeGenerator;


class MessageController
{
    private $codeGeneratorService;

    public function __construct(CodeGenerator $codeGenerator)
    {
        $this->codeGeneratorService = $codeGenerator;
    }

    public function send()
    {
        return $this->codeGeneratorService->sendGeneratedCode() ? 'code generated' : 'something went wrong';
    }
}