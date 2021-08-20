<?php


namespace MySite\app\Controllers;


use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class BaseController
{
    /**
     * @var ResponseInterface|Response|null
     */
    protected ?ResponseInterface $response;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * @param mixed $data
     * @return ResponseInterface
     */
    public function prepareResponse(mixed $data): ResponseInterface
    {
        $this->response->getBody()->write(
            $data
        );

        return $this->response;
    }
}
