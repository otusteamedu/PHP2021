<?php

namespace App;

use App\Contract\ValidatorInterface;
use App\DTO\Request;
use App\DTO\Response;
use App\Exception\BadMethodException;
use Exception;

class App
{
    private ValidatorInterface $validator;

    /**
     * App constructor.
     *
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $req = new Request($_POST['string'] ?? '');
                    $resp = $this->validator->validate($req);
                    Output::send($resp);
                    break;
                default:
                    throw new BadMethodException();
            }
        } catch (BadMethodException $e) {
            $resp = new Response($e->getMessage(), $e->getCode());
            Output::send($resp);
        }
    }
}
