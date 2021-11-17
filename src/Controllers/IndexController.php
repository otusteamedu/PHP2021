<?php

declare(strict_types=1);

namespace Sources\Controllers;

use Sources\Services\HttpResponse;
use Sources\Services\ParenthesesValidator;

class IndexController
{
    public function actionIndex(): void
    {
        echo 'Hello';
    }

    public function actionValidateParentheses(): void
    {
        $input = $_POST['string'] ?? '';
        $validator = new ParenthesesValidator($input);
        $validator->getValidation()->send();
    }
}