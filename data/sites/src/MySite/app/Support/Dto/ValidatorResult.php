<?php

declare(strict_types=1);

namespace MySite\app\Support\Dto;

/**
 * Class ValidatorResult
 * @package MySite\app\Support\Dto
 */
class ValidatorResult
{

    /**
     * @var bool
     */
    private bool $fail = true;

    /**
     * @var string
     */
    private string $message = 'Validation Error';
    /**
     * @var array
     */
    private array $validated = [];

    /**
     * @return array
     */
    public function validated(): array
    {
        return $this->validated;
    }


    public function addValidated(string $key, mixed $value): ValidatorResult
    {
        $this->validated[$key] = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFail(): bool
    {
        return $this->fail;
    }

    /**
     * @param bool $fail
     * @return ValidatorResult
     */
    public function setFail(bool $fail): ValidatorResult
    {
        $this->fail = $fail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return ValidatorResult
     */
    public function setMessage(?string $message): ValidatorResult
    {
        $this->message = $message;
        return $this;
    }
}
