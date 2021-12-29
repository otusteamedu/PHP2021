<?php

namespace App\Jobs;

interface RestRequestInterface
{
    public function getId(): int;

    public function setId(int $id): void;
}
