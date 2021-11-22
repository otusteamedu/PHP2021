<?php

declare(strict_types=1);

namespace MySite\app\Support\Http\DTO;


use MySite\app\Support\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var bool
     */
    private bool $ok = false;

    /**
     * @var string|null
     */
    private ?string $body = null;

    /**
     * @var int
     */
    private int $status = 0;

    /**
     * @return mixed
     */
    public function json(): mixed
    {
        $result = null;
        if ($this->body) {
            $result = json_decode($this->body, true);
        }
        return $result;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function set_status(int $status): static
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function set_body(string $body): static
    {
        $this->body = $body;
        return $this;
    }

    public function status(): int
    {
        return $this->status;
    }

    /**
     * @return ?string
     */
    public function body(): ?string
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function successful(): bool
    {
        return $this->status === 200;
    }

}
