<?php

namespace App\Mapper;

class Movie
{
    private $id;
    private $startTime;
    private $startEnd;
    private $idHall;
    private $movie;
    private $price;

    public function __construct($id, $startTime, $startEnd, $idHall, $movie, $price)
    {
        $this->id = $id;
        $this->startTime = $startTime;
        $this->startEnd = $startEnd;
        $this->idHall = $idHall;
        $this->movie = $movie;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStartEnd()
    {
        return $this->startEnd;
    }

    public function setStartEnd($startEnd)
    {
        $this->startEnd = $startEnd;

        return $this;
    }

    public function getIdHall()
    {
        return $this->idHall;
    }

    public function setIdHall($idHall)
    {
        $this->idHall = $idHall;

        return $this;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setpPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}