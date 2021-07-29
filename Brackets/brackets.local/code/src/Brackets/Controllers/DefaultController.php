<?php

declare(strict_types=1);

namespace Brackets\Controllers;


use Brackets\Tools\Filters\InputFilter;
use Brackets\Tools\Strings\BracketsValidator;
use Brackets\Tools\Exceptions\CustomException;


class DefaultController
{

    public function __construct()
    {

    }

    public function indexAction()
    {
        $inputString = InputFilter::getPostValue("string");
        if (is_null($inputString)) {
            CustomException::throwHTTPException(400, "No POST-param with name string passed");
        }

        $validator = new BracketsValidator($inputString);
        $isValid = $validator->isValid();
        if ($isValid) {
            echo "OK";
        } else {
            CustomException::throwHTTPException(400, "Wrong string!");
        }
    }

}