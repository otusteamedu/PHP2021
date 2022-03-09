<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 16:25
 */

namespace app\orders;

use app\dishes\Dish;

/**
 * Заказ
 *
 * Class Order
 * @package app\orders
 */
class Order
{
    /** @var string */
    const STATUS_CREATED = 'CREATED';

    /** @var string */
    const STATUS_DONE = 'DONE';

    /** @var string  */
    const STATUS_TRASH = 'TRASH';

    /** @var string  */
    const STATUS_CANCEL = 'CANCEL';

    /**
     * Блюдо
     *
     * @var Dish
     */
    private Dish $dish;

    /**
     * Статус заказа
     *
     * @var string
     */
    private string $status;

    /**
     * @param Dish $dish
     */
    public function __construct(Dish $dish)
    {
        $this->dish = $dish;
    }

    /**
     * Начало готовки
     *
     * @return void
     */
    public function startCook()
    {
        $this->status = self::STATUS_CREATED;
    }

    /**
     * Конец готовки
     *
     * @return void
     */
    public function doneCook()
    {
        $this->status = self::STATUS_DONE;
    }

    /**
     * Утилизация
     *
     * @return void
     */
    public function sendToTrash()
    {
        $this->status = self::STATUS_TRASH;
    }

    /**
     * Отмена
     *
     * @return void
     */
    public function cancelCook()
    {
        $this->status = self::STATUS_CANCEL;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Dish
     */
    public function getDish(): Dish
    {
        return $this->dish;
    }
}
