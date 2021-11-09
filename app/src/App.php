<?php

declare(strict_types=1);

namespace Src;

use Exception;

class App
{
    private const RESPONCE_CODE_BAD_REQUEST = 400;

    public function run(): void
    {
        try {
            if (empty($_REQUEST['string'])) {
                throw new Exception('String is empty');
            }

            $validatorBrackets = new ValidatorBrackets($_REQUEST['string']);
            $validatorBrackets->validate();
        } catch (Exception $e) {
            http_response_code(self::RESPONCE_CODE_BAD_REQUEST);
            echo $e->getMessage();
        }
    }
}
