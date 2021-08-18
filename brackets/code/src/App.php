<?php

namespace Validator;

use \Exception;
use Validator\Validator;

class App
{
    public function run()
    {
        if (!isset($_POST['string'])) {
            http_response_code(400);
            throw new Exception('Parameter string not found');
        }

        if (!$_POST['string']) {
            http_response_code(400);
            throw new Exception('Parameter string is empty');
        }
        
        if (Validator::check($_POST['string'])) {
            echo 'All right!';
        } else {
            http_response_code(404);
            throw new Exception('Incorrect string');
        }
    }
}
