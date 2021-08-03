<?php


declare(strict_types=1);


namespace Brackets\Tools\Response;


final class HttpResponseTransport
{

    /**
     * @param HttpResponse $httpResponse
     */
    public static function response(HttpResponse $httpResponse): void
    {
        header("HTTP/1.1 " . $httpResponse->getCode() . ": " . $httpResponse->getText());
        echo $httpResponse->getContent();
    }

}