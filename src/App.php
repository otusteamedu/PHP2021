<?php

namespace App;

use App\Service\Validator;
use App\Service\ValidatorException;
use Exception;

class App
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                try {
                    Validator::validate($_POST['string'] ?? '');
                } catch (ValidatorException $e) {
                    http_response_code(400);
                    echo $e->getMessage();
                }
                break;
            default:
                http_response_code(405);
        }
    }
}
