<?php

namespace MySite;

use MySite\Http\Emitter;
use MySite\Http\Request;
use MySite\Features\MailChecker\App as MailChecker;

/**
 * Class App
 * @package MySite
 */
class App
{

    /**
     *
     */
    public function run()
    {
        $request = new Request();
        $response = (new MailChecker())->run($request);
        (new Emitter())->emit($response);
    }
}
