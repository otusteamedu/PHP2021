<?php

namespace Yu2ry\App\Http\Controllers;

use Yu2ry\Support\Validations\Rules\ParenthesesRule;
use Yu2ry\Support\Validations\Rules\RuleData;
use Yu2ry\Support\Validations\Validator;

/**
 * Class HW4Controller
 * @package Yu2ry\App\Http\Controllers
 */
class HW4Controller
{

    private const REQUEST_STRING = 'string';

    private const LAST = 'last';

    /**
     * @return void
     */
    public function check(): void
    {
        session_start();

        header('Content-Type: text/plain');

        echo 'Last: ' . ($_SESSION[self::LAST] ?? 'Empty string') . PHP_EOL;

        $validator = new Validator();
        $validator->addRule(
            new ParenthesesRule(
                new RuleData($_GET[self::REQUEST_STRING] ?? null)
            )
        );
        if (!$validator->passes()) {
            echo $validator->getLastMessageError();
            return;
        }

        $_SESSION[self::LAST] = $_GET[self::REQUEST_STRING];
        session_commit();

        echo 'ok, Your data is saved';
    }
}