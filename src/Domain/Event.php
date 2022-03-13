<?php

namespace App\Domain;

/**
 * @OA\Schema()
 */
class Event
{
    public const STATUS_IN_PROCESS = 0;
    public const STATUS_COMPLETED = 1;

    private string $id;

    /**
     * @OA\Property(
     *   property="data",
     *   type="string",
     *   description="Event data"
     * )
     */
    private ?string $data;

    private ?int $status = null;

    public function __construct(string $id, ?string $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): Event
    {
        $this->status = $status;

        return $this;
    }
}
