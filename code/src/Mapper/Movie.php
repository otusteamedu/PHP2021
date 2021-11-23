<?php

namespace App\Mapper;

class Movie
{
    private int $id;
    private string $startTime;
    private string $startEnd;
    private int $idHall;
    private string $movie;
    private int $price;

    public function __construct( int $id, string $startTime, string $startEnd, int $idHall, string $movie, int $price)
    {
        $this->id = $id;
        $this->startTime = $startTime;
        $this->startEnd = $startEnd;
        $this->idHall = $idHall;
        $this->movie = $movie;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStartEnd(): string
    {
        return $this->startEnd;
    }

    public function setStartEnd(string $startEnd)
    {
        $this->startEnd = $startEnd;

        return $this;
    }

    public function getIdHall(): int
    {
        return $this->idHall;
    }

    public function setIdHall(int $idHall)
    {
        $this->idHall = $idHall;

        return $this;
    }

    public function getMovie(): string
    {
        return $this->movie;
    }

    public function setMovie(string $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setpPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }
}