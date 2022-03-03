<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 02.03.2022
 * Time: 17:45
 */

namespace app;

use PDO;
use PDOStatement;

/**
 * Построитель запросов
 *
 * Class QueryBuilder
 * @package app
 */
class QueryBuilder
{
    /**
     * @var string
     */
    private string $operation;

    /**
     * @var string
     */
    private string $condition;

    /**
     * @var string
     */
    private string $className;

    /**
     * @var string
     */
    private string $from;
    private PDO $pdo;
    private IdentityMap $identityMap;

    /**
     * @param string $className
     * @param PDO $pdo
     * @param IdentityMap $identityMap
     */
    public function __construct(string $className, PDO $pdo, IdentityMap $identityMap)
    {
        $this->className = $className;
        $this->pdo = $pdo;
        $this->identityMap = $identityMap;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function select(string $value): QueryBuilder
    {
        /** @var BaseActiveRecord $className */
        $className = $this->className;
        $table = $className::getTableName();

        $this->operation = "SELECT $value";
        $this->from = "FROM $table";

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function where(array $data): QueryBuilder
    {
        if (empty($data) === true) {
            return $this;
        }

        $condition = http_build_query($data, '', ', ');
        $this->condition = "WHERE $condition";

        return $this;
    }

    /**
     * Запрос в строку
     *
     * @return string
     */
    public function asRaw(): string
    {
        $result = array_filter([
            $this->operation,
            $this->from,
            $this->condition,
        ]);

        return implode(' ', $result);
    }

    /**
     * Получение AR модели
     *
     * @return BaseActiveRecord
     */
    public function one(): BaseActiveRecord
    {
        $pdo = $this->pdo;

        $sth = $this->executeQuery();
        $queryData = $sth->fetch($pdo::FETCH_ASSOC);

        return $this->prepareModel($queryData);
    }

    /**
     * Коллекция моделей
     *
     * @return BaseActiveRecord[]
     */
    public function all(): array
    {
        $sth = $this->executeQuery();
        $queryData = $sth->fetchAll();

        return array_map(
            static function (array $datum) {
                return $this->prepareModel($datum);
            },
            $queryData
        );
    }

    /**
     * Подготовка модели
     *
     * @param array $queryData
     * @return BaseActiveRecord
     */
    private function prepareModel(array $queryData): BaseActiveRecord
    {
        $identityMap = $this->identityMap;
        /** @var BaseActiveRecord $className */
        $className = $this->className;

        $model = $className::instance($queryData);

        if ($identityMap->isset($model) === true) {
            return $identityMap->get($model);
        }

        $identityMap->add($model);

        return $model;
    }

    /**
     * Выполнение запроса
     *
     * @return false|PDOStatement
     */
    private function executeQuery()
    {
        $pdo = $this->pdo;
        $sql = $this->asRaw();

        $sth = $pdo->prepare($sql);
        $sth->execute();

        return $sth;
    }
}
