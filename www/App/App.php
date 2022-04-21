<?php

declare(strict_types=1);

namespace App;

use App\Requests\Request;
use App\Validators\EmailValidator;

class App
{

    public function run(): void
    {
        if (count($_REQUEST) > 0) {
            $request = (new Request($_REQUEST))->all();

            (new EmailValidator($request))->run();
        } else {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/Views/form.php');
        }
    }
}
