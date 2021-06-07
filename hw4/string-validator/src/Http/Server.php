<?php declare(strict_types=1);

namespace App\Http;

use App\Http\Handler\Handler;
use App\Http\Request\RequestFactory;
use App\Validator\BracketsValidator;

class Server
{
    public function run()
    {
        $handler = new Handler(new BracketsValidator());

        $request = RequestFactory::createFromGlobal();
        $response = $handler->handle($request);

        foreach ($response->getHeaders() as $name => $value) {
            \header("$name: $value");
        }

        \http_response_code($response->getStatus());
        echo $response->getBody();
    }
}
