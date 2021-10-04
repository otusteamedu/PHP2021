<?php

declare(strict_types=1);

namespace Orders\Data\Storage;

use PDO;
use PDOStatement;

final class StorageAdapter
{

    private const KEY_FIELD = 'id';

    /**
     * @var PDO
     */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
    }

    public function createQuery(string $string)
    {
        $this->pdo->prepare($string)->execute();
    }

    /**
     * @param int $id
     * @param string $tableName
     * @return array|null
     */
    public function getDataById(int $id, string $tableName): ?array
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM ' . $tableName . ' WHERE id = ?');
        $selectStatement->execute([$id]);
        $result = $selectStatement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * @param string $tableName
     * @return array|null
     */
    public function getAll(string $tableName): ?array
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM ' . $tableName);
        $selectStatement->execute();
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * @param int $id
     * @param string $tableName
     * @return bool
     */
    public function deleteById(int $id, string $tableName): bool
    {
        $deleteStatement = $this->pdo->prepare('DELETE FROM ' . $tableName . ' WHERE id = ?');
        return $deleteStatement->execute([$id]);
    }

    public function deleteAll(string $tableName): bool
    {
        $deleteStatement = $this->pdo->prepare('DELETE FROM ' . $tableName);
        return $deleteStatement->execute();
    }

    /**
     * @param $array
     * @param string $tableName
     * @return int|bool
     */
    public function saveData($array, string $tableName): int|bool
    {
        $sqlRow = "INSERT INTO $tableName(";
        $bindRow = "";
        $updateFields = [];
        $params = [];
        $updateParams = [];

        foreach ($array as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            if ($key != self::KEY_FIELD) {
                $updateFields[] = "$key = ?";
                $updateParams[] = $value;
            }

            if (!empty($params)) {
                $sqlRow .= ", ";
                $bindRow .= ", ";
            }

            $sqlRow .= $key;
            $bindRow .= "?";

            $params[] = $value;
        }

        $sqlRow .= ") VALUES($bindRow) ON DUPLICATE KEY UPDATE " . implode(",", $updateFields);

        $insertUpdateStatement = $this->pdo->prepare($sqlRow);
        $result = $insertUpdateStatement->execute(array_merge($params, $updateParams));

        if ($result && !isset($array['id'])) {
            return $this->returnLastInsertId();
        }
        return $result;
    }

    /**
     * @return int
     */
    private function returnLastInsertId(): int
    {
        return intval($this->pdo->lastInsertId());
    }

}