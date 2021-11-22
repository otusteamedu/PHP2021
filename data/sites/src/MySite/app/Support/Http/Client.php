<?php

declare(strict_types=1);

namespace MySite\app\Support\Http;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Contracts\ResponseInterface;
use MySite\app\Support\Http\DTO\Response;

/**
 * Class Client
 * @package MySite\app\Support\Http
 */
final class Client
{
    /**
     * @var HttpClient|null
     */
    private ?HttpClient $client = null;

    /**
     * @var Response|null
     */
    private ?Response $response = null;

    public function __construct()
    {
        $this->client = new HttpClient();
        $this->response = new Response();
    }

    /**
     * @param string $url
     * @return ResponseInterface|null
     * @throws GuzzleException
     */
    public function get(string $url): ?ResponseInterface
    {
        $request = $this->client->request(
            'get',
            $url,
            [
                'http_errors' => false
            ]
        );
        $this->response
            ->set_status($request->getStatusCode())
            ->set_body($request->getBody()->getContents());
        return $this->response;
    }
}
