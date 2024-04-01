<?php

namespace Application\Contracts;

interface Character
{
    public function getId(): int;

    public function setId(int $id): self;

    public function getNickname(): string;

    public function setNickname(string $nickname): self;

    public function getRealName(): string;

    public function setRealName(string $realName): self;

    public function getForce(): string;

    public function setForce(string $force): self;
}
