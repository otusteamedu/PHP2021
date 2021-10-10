<?php

declare(strict_types=1);

namespace Orders\Data\Storage;

interface StorageAdapter
{

    /**
     * @param string $string
     * @return mixed
     */
    public function createQuery(string $string);

    /**
     * @param int $id
     * @param string $tableName
     * @return object|null
     */
    public function getDataById(int $id, string $tableName, string $classToMap): ?object;

    /**
     * @param string $tableName
     * @param string $classToMap
     * @return array|null
     */
    public function getAll(string $tableName, string $classToMap): ?array;

    /**
     * @param int $id
     * @param string $tableName
     * @return bool
     */
    public function deleteById(int $id, string $tableName): bool;

    /**
     * @param string $tableName
     * @return bool
     */
    public function deleteAll(string $tableName): bool;

    /**
     * @param $array
     * @param string $tableName
     * @return int|bool
     */
    public function saveData($array, string $tableName): int|bool;

}