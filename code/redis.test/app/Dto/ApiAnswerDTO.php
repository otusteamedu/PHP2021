<?php

declare(strict_types=1);

namespace App\Dto;

final class ApiAnswerDTO
{

    public function __construct(private bool $success, private string $data)
    {
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

}
