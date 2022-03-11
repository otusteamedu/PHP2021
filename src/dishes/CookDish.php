<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 19:24
 */

namespace app\dishes;

use app\orders\OrderManagerFactory;
use app\receipts\ReceiptInterface;

/**
 * Приготовить блюдо
 *
 * Class CreateOrder
 * @package app\orders
 */
class CookDish
{
    /**
     * Рецепт
     *
     * @var ReceiptInterface
     */
    private ReceiptInterface $receipt;

    /**
     * Блюдо
     *
     * @var Dish|null
     */
    private ?Dish $dish;

    /**
     * @param ReceiptInterface $receipt
     */
    public function __construct(ReceiptInterface $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Выполнение
     *
     * @return void
     */
    public function execute()
    {
        $this->makeDish();
        $this->processOrder();
    }

    /**
     * Формирование блюда
     *
     * @return void
     */
    private function makeDish()
    {
        $dish = $this
            ->receipt
            ->make();

        $this->dish = $dish;
    }

    /**
     * Выполнение заказа
     *
     * @return void
     */
    private function processOrder()
    {
        $dish = $this->dish;
        $order = OrderManagerFactory::checker($dish);

        $order->start();
        $order->done();
    }
}
