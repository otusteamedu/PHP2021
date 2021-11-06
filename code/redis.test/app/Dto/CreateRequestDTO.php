<?php

declare(strict_types=1);

namespace App\Dto;

final class CreateRequestDTO
{

    private string $status;

    public function __construct(private string $messageId, private string $data = '', string $status = '')
    {
        if (in_array($status, config('enums.message_status'))) {
            $this->status = $status;
        } else {
            $this->status = config('enums.message_status.IN_PROGRESS');
        }
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

}
