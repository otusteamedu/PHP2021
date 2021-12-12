<?php

declare(strict_types=1);

namespace Vshepelev\App;

use JsonException;
use JetBrains\PhpStorm\Pure;
use Vshepelev\App\Response\Response;
use Vshepelev\App\Response\HttpStatus;

class Application
{
    private Config $config;

    #[Pure]
    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * @throws JsonException
     */
    public function handleHttpRequest(): void
    {
        $this->handle(Request::capture())->send();
    }

    private function handle(Request $request): Response
    {
        $router = new Router($this->config->get('routes'));
        if (!$action = $router->getAction($request->method(), $request->uri())) {
            return new Response('Route not found', HttpStatus::NOT_FOUND);
        }

        return $action($request);
    }
}
