<?php

declare(strict_types=1);

namespace MySite\domain\Support\Facades;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Http
 * @package MySite\domain\Support\Facades
 */
class Http
{

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function get(string $url): ResponseInterface
    {
        return (new Client())->get($url);
    }
}
