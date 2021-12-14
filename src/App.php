<?php

namespace App;

use App\Exception\BadMethodException;
use App\Exception\BadRequestException;
use App\Service\Validator;
use Exception;

class App
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $str = $_POST['string'] ?? '';
                    if (empty($str)) {
                        throw new BadRequestException(
                            BadRequestException::EMPTY
                        );
                    }

                    if (!Validator::validate($str)) {
                        throw new BadRequestException(
                            BadRequestException::INCORRECT
                        );
                    }

                    Response::output(
                        'String validation completed successfully!'
                    );
                    break;
                default:
                    throw new BadMethodException();
            }
        } catch (BadMethodException|BadRequestException $e) {
            Response::output($e->getMessage(), $e->getCode());
        }
    }
}
