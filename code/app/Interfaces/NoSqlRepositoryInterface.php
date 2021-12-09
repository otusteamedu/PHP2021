<?php
namespace App\Interfaces;

interface NoSqlRepositoryInterface
{
    public function addEvent(int $priority, array $conditions, string $event):void;

    public function findByCondition(array $conditions):string;

    public function deleteAllEvents():void;
}
