<?php

namespace Src;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_BAD_REQUEST = 400;

    private string $body;

    private int $statusCode;

    private string $statusText;

    private array $headers;

    private string $version;

    private static array $statusTexts = [
        200 => 'OK',
        400 => 'Bad Request',
    ];

    /**
     * Responce constructor.
     *
     * @param string|null $body
     * @param int $status
     * @param array $headers
     * @param string $version
     */
    public function __construct(?string $body = '', int $status = 200, array $headers = [], string $version = '1.1')
    {
        $this->setBody($body);
        $this->setStatusCode($status);
        $this->headers = $headers;
        $this->version = $version;
    }

    /**
     * @param int $code
     */
    private function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
        if ($this->isInvalid()) {
            $this->statusCode = self::HTTP_OK;
        }

        $this->statusText = self::$statusTexts[$this->statusCode] ?? 'Unknown status';
    }

    /**
     * @return bool
     */
    private function isInvalid(): bool
    {
        return $this->statusCode < 100 || $this->statusCode >= 600;
    }

    /**
     * @param string|null $body
     */
    private function setBody(?string $body): void
    {
        $this->body = $body ?? '';
    }

    private function sendHeaders(): void
    {
        if (headers_sent()) {
            return;
        }

        foreach ($this->headers as $name => $value) {
            header(sprintf('%s: %s', $name, $value), true, $this->statusCode);
        }

        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);
    }

    private function sendBody(): void
    {
        echo $this->body;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
    }
}
