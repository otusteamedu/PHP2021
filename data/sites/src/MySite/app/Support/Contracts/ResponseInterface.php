<?php


namespace MySite\app\Support\Contracts;

/**
 * Interface ResponseInterface
 * @package MySite\app\Support\Contracts
 */
interface ResponseInterface
{

    /**
     * @return mixed
     */
    public function json(): mixed;

    /**
     * @return int
     */
    public function status(): int;

    /**
     * @return string|null
     */
    public function body(): ?string;

    /**
     * @return bool
     */
    public function successful(): bool;
}
