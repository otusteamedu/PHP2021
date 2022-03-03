<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 02.03.2022
 * Time: 20:52
 */

namespace app;

/**
 * Хранилище ссылок на модели
 *
 * Class IdentityMap
 * @package app
 */
class IdentityMap
{
    /**
     * @var IdentityMap|null $this
     */
    private static ?self $instance = null;

    /**
     * @var BaseActiveRecord[]
     */
    private array $classMap = [];

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Экземпляр объекта
     *
     * @return IdentityMap
     */
    public static function instance(): IdentityMap
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Добавление AR записи
     *
     * @param BaseActiveRecord $activeRecord
     * @return void
     */
    public function add(BaseActiveRecord $activeRecord)
    {
        if ($this->isset($activeRecord) === true) {
            return;
        }

        $key = $this->getActiveRecordKey($activeRecord);
        static::$instance->classMap[$key] = $activeRecord;
    }

    /**
     * Получение AR записи
     *
     * @param BaseActiveRecord $activeRecord
     * @return BaseActiveRecord|null
     */
    public function get(BaseActiveRecord $activeRecord): ?BaseActiveRecord
    {
        if ($this->isset($activeRecord) === false) {
            return null;
        }

        $key = $this->getActiveRecordKey($activeRecord);

        return static::$instance->classMap[$key];
    }

    /**
     * Проверка на существование
     *
     * @param BaseActiveRecord $activeRecord
     * @return bool
     */
    public function isset(BaseActiveRecord $activeRecord): bool
    {
        $key = $this->getActiveRecordKey($activeRecord);

        return array_key_exists($key, static::$instance->classMap);
    }

    /**
     * Уникальный ключ объекта
     *
     * @param BaseActiveRecord $activeRecord
     * @return string
     */
    private function getActiveRecordKey(BaseActiveRecord $activeRecord): string
    {
        return implode(":", [
            get_class($activeRecord),
            $activeRecord->getPrimaryKey()
        ]);
    }
}
