<?php

namespace Src;

use Src\Service\CSV;
use Src\Service\Validator;


class App
{
    public function run()
    {
        try {
            (new Validator())->Email((new CSV())->getEmails());
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }
}