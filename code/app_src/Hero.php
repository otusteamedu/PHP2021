<?php

namespace App;

class Hero
{
    private int $id;
    private string $class;
    private string $name;
    private string $race;

    public function __construct(
        int $id,
        string $class,
        string $name,
        string $race
    )
    {
        $this->id = $id;
        $this->class = $class;
        $this->name = $name;
        $this->race = $race;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRace(): string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }
}
