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
     * @var BaseActiveRecord[]
     */
    private static array $classMap = [];

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
        self::$classMap[$key] = $activeRecord;
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

        return self::$classMap[$key];
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

        return array_key_exists($key, self::$classMap);
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
