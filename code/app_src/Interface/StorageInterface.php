<?php
declare(strict_types=1);
namespace App\Interface;

interface StorageInterface
{
    public function insert(string $arData);

    public function delete(string $arData);

    public function search(string $arData);
}