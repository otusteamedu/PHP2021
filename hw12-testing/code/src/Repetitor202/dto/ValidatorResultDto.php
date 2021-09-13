<?php

namespace Repetitor202\dto;

class ValidatorResultDto
{
    private bool $isValid = true;

    private string $message = 'OK!';

    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}