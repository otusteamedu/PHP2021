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
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        $setter = "set" . StringHelper::id2camel($name);

        if (method_exists($this, $setter) === true) {
            $this->$setter($value);
        }
    }

    /**
     * Построитель запросов
     *
     * @return QueryBuilder
     */
    public static function getQueryBuilder(): QueryBuilder
    {
        $pdo = DataBase::instance();
        $identityMap = new IdentityMap();

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
