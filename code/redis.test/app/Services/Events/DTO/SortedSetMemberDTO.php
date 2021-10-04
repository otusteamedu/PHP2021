<?php

declare(strict_types=1);

namespace App\Services\Events\DTO;

final class SortedSetMemberDTO
{

    /**
     * @var string
     */
    private string $key;

    /**
     * @var float
     */
    private float $order;

    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $key
     * @param float $order
     * @param string $value
     */
    public function __construct(
        string $key,
        float  $order,
        string $value
    )
    {
        $this->key = $key;
        $this->order = $order;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return float
     */
    public function getOrder(): float
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

}
