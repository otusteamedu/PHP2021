<?php

namespace App;

class Hero
{

    public function __construct(
        private int $id,
        private string $nickname,
        private string $realName,
        private string $force,
    )
    {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getRealName(): string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getForce(): string
    {
        return $this->force;
    }

    public function setForce(string $force): self
    {
        $this->force = $force;

        return $this;
    }
}
