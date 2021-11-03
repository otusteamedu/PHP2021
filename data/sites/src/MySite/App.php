<?php

namespace MySite;

use JetBrains\PhpStorm\NoReturn;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

/**
 * Class App
 * @package MySite
 */
class App
{

    /**
     *
     */
    #[NoReturn] public function run(): void
    {
        $psr17Factory = new Psr17Factory;

        $creator = new ServerRequestCreator(
            $psr17Factory, // ServerRequestFactory
            $psr17Factory, // UriFactory
            $psr17Factory, // UploadedFileFactory
            $psr17Factory  // StreamFactory
        );

        $serverRequest = $creator->fromGlobals();

        $feature = new Features\StringTester\App;

        $feature->run($serverRequest);

        $responseBody = $psr17Factory->createStream($feature->getResponse());

        $serverResponse = $psr17Factory
            ->createResponse($feature->getCode())
            ->withBody($responseBody);
        
        (new SapiEmitter())->emit($serverResponse);
    }
}
