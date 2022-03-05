<?php

namespace App\Domain;

class CinemaMovie
{
    private int $id;
    private string $nameOriginal;
    private ?string $nameLoc;
    private int $durationMin;

    /**
     * @param int         $id
     * @param string      $nameOriginal
     * @param string|null $nameLoc
     * @param int         $durationMin
     */
    public function __construct(
        int $id,
        string $nameOriginal,
        ?string $nameLoc,
        int $durationMin
    ) {
        $this->id = $id;
        $this->nameOriginal = $nameOriginal;
        $this->nameLoc = $nameLoc;
        $this->durationMin = $durationMin;
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
    public function getNameOriginal(): string
    {
        return $this->nameOriginal;
    }

    /**
     * @return string|null
     */
    public function getNameLoc(): ?string
    {
        return $this->nameLoc;
    }

    /**
     * @return int
     */
    public function getDurationMin(): int
    {
        return $this->durationMin;
    }
}
