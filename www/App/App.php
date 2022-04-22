<?php

declare(strict_types=1);

namespace App;

use App\Requests\Request;
use App\Validators\EmailValidator;

class App
{

    public function run(): void
    {
        if (count($_POST) > 0) {
            if (isset($this->request['email']) && !empty($this->request['email'])) {
                $request = (new Request($_POST))->all();

                (new EmailValidator($request))->run();
            } else {
                echo 'Email str is empty :(';
            }
        } else {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/Views/form.php');
        }
    }
}
