<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 02.03.2022
 * Time: 16:59
 */

namespace app;

/**
 * Базовый класс AR
 *
 * Class BaseActiveRecord
 * @package ${NAMESPACE}
 */
abstract class BaseActiveRecord
{
    /**
     * Построитель запросов
     *
     * @return QueryBuilder
     */
    public static function getQueryBuilder(): QueryBuilder
    {
        $pdo = DataBase::instance();
        $identityMap = IdentityMap::instance();

        return new QueryBuilder(get_called_class(), $pdo, $identityMap);
    }

    /**
     * Первичный ключ
     *
     * @return int
     */
    abstract public function getPrimaryKey(): int;

    /**
     * Название таблицы
     *
     * @return string
     */
    abstract public static function getTableName(): string;

    /**
     * Создание модели
     *
     * @param array $queryData
     * @return BaseActiveRecord
     */
    abstract public static function instance(array $queryData): self;

    /**
     * Поиск записи по ID
     *
     * @param int $id
     * @return self|null
     */
    public static function findOne(int $id): ?self
    {
        return static::getQueryBuilder()
            ->select('*')
            ->where(['id' => $id])
            ->one();
    }

    /**
     * Коллекция записей по условиям
     *
     * @return self[]
     */
    public static function findAll(array $conditions = []): array
    {
        return static::getQueryBuilder()
            ->select('*')
            ->where($conditions)
            ->all();
    }
}
