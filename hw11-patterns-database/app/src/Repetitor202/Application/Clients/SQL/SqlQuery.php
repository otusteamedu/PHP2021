<?php


namespace Repetitor202\Application\Clients\SQL;


abstract class SqlQuery
{
    abstract public static function selectItems(string $table, array $params = []): ?array;

    abstract public static function findById(string $table, $identificator): ?array;

    abstract public static function createOneItem(string $table, array $params, $identificator = null): bool;

//TODO:    abstract public static function createManyItems(string $table, array $params): bool;

    abstract public static function updateOneItem(string $table, array $params, $identificator): bool;

//TODO:    abstract public static function updateManyItems(string $table, array $params): bool;

    abstract public static function createUpdateOneItem(string $table, array $params, $identificator): bool;

    abstract public static function deleteById(string $table, $identificator): bool;

    abstract public static function deleteByParams(string $table, array $params): bool;

//TODO:    abstract public static function nativeQuery(string $query): bool;
}