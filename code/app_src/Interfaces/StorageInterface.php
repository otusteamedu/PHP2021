<?php

namespace App\Interfaces;

interface StorageInterface
{
    public function insert(array $arData): array;

    public function deleteAll(): array;

    public function searchEvent(array $arData): array;
}
