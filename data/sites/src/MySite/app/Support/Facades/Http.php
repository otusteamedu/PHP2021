<?php

declare(strict_types=1);

namespace MySite\app\Support\Facades;

use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Contracts\ResponseInterface;
use MySite\app\Support\Http\Client;

/**
 * Class Http
 * @package MySite\app\Support\Facades
 */
class Http
{
    /**
     * @param string $url
     * @return ResponseInterface|null
     * @throws GuzzleException
     */
    public static function get(string $url): ?ResponseInterface
    {
        return (new Client())->get($url);
    }
}
