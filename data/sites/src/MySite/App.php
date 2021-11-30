<?php

namespace MySite;

use MySite\Http\Emitter;
use MySite\Http\Request;
use MySite\Features\Payment\App as Payment;

/**
 * Class App
 * @package MySite
 */
class App
{

    /**
     * single entry point into application
     */
    public function run(): void
    {
        $request = new Request();
        $response = (new Payment())->run($request);
        (new Emitter())->emit($response);
    }
}
