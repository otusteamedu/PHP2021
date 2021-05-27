<?php


namespace MySite\Http;

/**
 * Class Response
 * @package MySite\Http
 */
class Response implements HttpCodes
{
    /**
     * @var string
     */
    private string $body = '';

    /**
     * @var int
     */
    private int $status = HttpCodes::NOT_FOUND;

    /**
     * @var string
     */
    private string $reasonPhrase = '';

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }


    /**
     * @param string $body
     */
    public function withBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status;
    }

    /**
     * @param int $code
     * @param string $reasonPhrase
     */
    public function withStatus(int $code, string $reasonPhrase = '')
    {
        $this->status = $code;
        $this->reasonPhrase = $reasonPhrase;
    }


    /**
     * @return string
     */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return preg_replace('/[^\d.]/', '', $_SERVER['SERVER_PROTOCOL']);
    }
}
