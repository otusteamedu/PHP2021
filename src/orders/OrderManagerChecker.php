<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 17:29
 */

namespace app\orders;

/**
 * Проверка заказа (прокси)
 *
 * Class CookManagerChecker
 * @package app\orders
 */
class OrderManagerChecker implements OrderManagerInterface
{
    /**
     * Менеджер приготовления заказа
     *
     * @var OrderManager
     */
    private OrderManager $cookManager;

    /**
     * @param OrderManager $cookManager
     */
    public function __construct(OrderManager $cookManager)
    {
        $this->cookManager = $cookManager;
    }

    /**
     * @inheritDoc
     */
    public function start()
    {
        $cookManager = $this->cookManager;

        if ($this->hasIngredients() === true) {
            $cookManager->start();

            return;
        }

        $cookManager->cancel();
    }

    /**
     * @inheritDoc
     */
    public function done()
    {
        $cookManager = $this->cookManager;

        if ($this->isStandardsCompliance() === true) {
            $cookManager->done();

            return;
        }

        $cookManager->trash();
    }

    /**
     * Проверка доступного количества ингредиентов
     *
     * @return bool
     */
    private function hasIngredients(): bool
    {
        $cookManager = $this->cookManager;
        $order = $cookManager->getOrder();
        $dish = $order->getDish();
        $ingredients = $dish->getIngredients();

        return count($ingredients) > 1;
    }

    /**
     * Соответствует стандарту
     *
     * @return bool
     */
    private function isStandardsCompliance(): bool
    {
        return true;
    }
}
