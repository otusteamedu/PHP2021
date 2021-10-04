<?php

declare(strict_types=1);

namespace Orders\Data;

final class Order
{

    /**
     * @var int|null
     */
    private ?int $id;

    /**
     * @var float
     */
    private float $summ;

    /**
     * @var string
     */
    private string $created_at;

    /**
     * @param float $summ
     * @param string $created_at
     * @param int|null $id
     */
    public function __construct(float $summ, string $created_at, ?int $id = null)
    {
        $this->id = $id;
        $this->summ = $summ;
        $this->created_at = $created_at;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'summ' => $this->summ,
            'created_at' => $this->created_at,
        ];
    }

    /**
     * @param array $state
     * @return Order
     */
    public static function fromState(array $state): Order
    {
        return new self(
            floatval($state['summ']),
            $state['created_at'],
            intval($state['id'])
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getSumm(): float
    {
        return $this->summ;
    }

    /**
     * @param float $summ
     * @return $this
     */
    public function setSumm(float $summ): Order
    {
        $this->summ = $summ;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): Order
    {
        $this->created_at = $createdAt;
        return $this;
    }

}