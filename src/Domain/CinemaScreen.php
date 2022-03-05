<?php

namespace App\Domain;

class CinemaScreen
{
    private int $id;
    private string $name;
    private int $maxSeats;

    /**
     * @param int    $id
     * @param string $name
     * @param int    $maxSeats
     */
    public function __construct(int $id, string $name, int $maxSeats)
    {
        $this->id = $id;
        $this->name = $name;
        $this->maxSeats = $maxSeats;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMaxSeats(): int
    {
        return $this->maxSeats;
    }
}
