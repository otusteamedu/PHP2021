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
    private float $options;

    /**
     * @var string
     */
    private string $score;

    /**
     * @param string $key
     * @param float $options
     * @param string $score
     */
    public function __construct(
        string $key,
        float  $options,
        string $score
    )
    {
        $this->key = $key;
        $this->options = $options;
        $this->score = $score;
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
    public function getOptions(): float
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getScore(): string
    {
        return $this->score;
    }

}
