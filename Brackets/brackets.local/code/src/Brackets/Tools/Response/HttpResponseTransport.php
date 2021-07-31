<?php


declare(strict_types=1);


namespace Brackets\Tools\Response;


final class HttpResponseTransport
{

    /**
     * @param int $code Response code
     * @param string $text Response text
     */
    public static function response(HttpRespone $httpResponse): void
    {
        header("HTTP/1.1 " . $httpResponse->getCode() . ": " . $httpResponse->getText());
        echo $httpResponse->getContent();
    }

}