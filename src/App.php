<?php

namespace App;

use App\Service\Validator;
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
                Validator::validate($_POST['string'] ?? '');
                break;
            default:
                throw new Exception('Request Method Not Allowed', 405);
        }
    }
}
