<?php
namespace App\Interfaces;

interface NoSqlRepositoryInterface
{
    public function addEvent(int $priority, array $conditions, string $event);

    public function findByCondition(array $conditions);
}