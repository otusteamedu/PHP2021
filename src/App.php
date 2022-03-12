<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.03.2022
 * Time: 17:44
 */

namespace app;

use app\dishes\CookDish;
use app\receipts\ReceiptFactory;
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
        $receipt = ReceiptFactory::create($receiptName);

        $cookDish = new CookDish($receipt);
        $cookDish->execute();
    }
}
