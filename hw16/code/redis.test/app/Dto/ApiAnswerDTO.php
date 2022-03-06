<?php

declare(strict_types=1);

namespace App\Dto;

final class ApiAnswerDTO
{

    public function __construct(private bool $success, private mixed $data, private int $statusCode = 200)
    {
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

}
