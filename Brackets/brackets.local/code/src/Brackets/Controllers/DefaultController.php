<?php

declare(strict_types=1);

namespace Brackets\Controllers;


use Brackets\Tools\Response\HttpResponseTransport;
use Brackets\Tools\Service\ValidationService;


final class DefaultController
{

    public function __construct()
    {

    }

    /**
     * Index action
     */
    public function indexAction(): void
    {
        $inputString = $_POST["string"] ?? null;
        $validationService = new ValidationService($inputString);
        $httpAnswer = $validationService->getBracketsValidation();
        HttpResponseTransport::response($httpAnswer);
    }

}