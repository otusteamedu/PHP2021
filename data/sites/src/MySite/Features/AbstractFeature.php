<?php

namespace MySite\Features;

use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractFeature
{
    /**
     * @var string
     */
    private string $response = 'Bad Request';

    /**
     * @var int
     */
    private int $code = 400;

    /**
     * @param ServerRequestInterface $request
     */
    abstract function run(ServerRequestInterface $request): void;

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    protected function setResponse(string $response): void
    {
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    protected function setCode(string $code): void
    {
        $this->code = $code;
    }
}
