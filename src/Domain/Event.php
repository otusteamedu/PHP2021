<?php

namespace App\Domain;

use Exception;

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
    private string $data;

    private ?int $status = null;

    /**
     * @param string $data
     * @throws Exception
     */
    public function __construct(string $data)
    {
        if (empty($data)) throw new Exception('event is not valid');
        $this->id = uniqid();
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): Event
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return $this
     */
    public function setStatus(?int $status): Event
    {
        $this->status = $status;
        return $this;
    }
}