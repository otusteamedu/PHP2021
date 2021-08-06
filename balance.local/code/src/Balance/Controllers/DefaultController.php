<?php

declare(strict_types=1);


namespace Balance\Controllers;


use Balance\Tools\Response\HttpResponseTransport;
use Balance\Tools\Service\ValidationService;


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
        $inputString = $_POST["email"] ?? null;
        $validationService = new ValidationService($inputString, true);
        $httpAnswer = $validationService->getEmailValidation();
        HttpResponseTransport::response($httpAnswer);
    }

}