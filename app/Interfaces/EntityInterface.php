<?php

namespace App\Interfaces;

interface EntityInterface
{
    public function getId(): int;

    public function setId(): self;
}