<?php

namespace App;

use App\App;
use Throwable;
use App\Response;

class RequestHandler
{
    public function sendBadRequest(): void
    {
        header('HTTP/1.1 400 Bad Request');
        header('Status: 400 Bad Request');
    }

    public function sendServerError(Throwable $e): void
    {
        header('HTTP/1.1 500 Internal Server Error');
        header('Status: 500 Internal Server Error');
        echo $e->getMessage() . PHP_EOL;
    }

    public function sendOk(string $content = ''): void
    {
        echo $content;
    }

    private function runApp(): Response
    {
        $string = $_REQUEST['string'] ?? null;

        $app = new App();

        return $app->run($string);
    }

    public function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendBadRequest();
        }

        $response = $this->runApp();

        if ($response->getResult() === false) {
            $this->sendBadRequest();
        } else {
            $this->sendOk($response->getMessage());
        }
    }
}
