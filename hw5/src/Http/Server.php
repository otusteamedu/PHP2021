<?php declare(strict_types=1);

namespace App\Http;

use App\Http\Interfaces\EmitterInterface;
use App\Http\Interfaces\HandlerInterface;
use App\Http\Request\Request;
use App\Http\Response\JsonResponse;

class Server
{
    public function __construct(
        private HandlerInterface $handler,
        private EmitterInterface $emitter
    ){
    }

    public function run()
    {
        try {
            $response = $this->handler->handle(new Request());
        } catch (\JsonException) {
            $response = new JsonResponse(400, ['message' => 'Invalid json']);
        } catch (\Throwable $e) {
            $response = new JsonResponse(500, ['message' => 'Internal server error']);
        }

        $this->emitter->emit($response);
    }
}
