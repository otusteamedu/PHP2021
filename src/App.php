<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:00
 */

namespace app;

use app\dishes\AddIngredient;
use app\dishes\DishManager;
use app\ingredients\CheeseIngredient;
use app\ingredients\ChileSauceIngredient;
use app\orders\CookManagerFactory;
use app\orders\Order;
use app\receipts\ReceiptCreateFactory;
use Exception;

/**
 * Приложение
 *
 * Class App
 * @package app
 */
class App
{
    /**
     * @throws Exception
     */
    public function run(array $argv)
    {
        list(, $receiptName) = $argv;

        switch ($receiptName) {
            case 'burger':
                $receipt = ReceiptCreateFactory::burger();

                break;
            case 'sandwich':
                $receipt = ReceiptCreateFactory::sandwich();

                break;
            case 'hotDog':
                $receipt = ReceiptCreateFactory::hotDog();

                break;
            default:
                throw new Exception("Receipt not found");
        }

        $dishManager = new DishManager();
        $dishManager->setReceipt($receipt);

        $dish = $dishManager->getDish();

        $dish = new AddIngredient($dish, new ChileSauceIngredient());
        $dish = new AddIngredient($dish, new CheeseIngredient());

        $order = new Order($dish);

        $cookManager = CookManagerFactory::checker($order);
        $cookManager->start();

        $cookManager->done();
    }
}
