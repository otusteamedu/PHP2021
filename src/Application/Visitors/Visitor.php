<?php


namespace App\Application\Visitors;


use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;

class Visitor implements VisitorInterface
{
    public function visitHotDog(HotDog $hotDog)
    {

    }

    public function visitBurger(Burger $burger)
    {
        $status = count($burger->fillings) / count($burger->getReceiptFilling());
        if ($status === 1) {
            echo 'Бургер готов полностью';
        } else {
            echo 'Бургер готов на ' . count($burger->fillings) / count($burger->getReceiptFilling()) . '<br>';
        }
    }

    public function visitSandwich(Sandwich $sandwich)
    {

    }
}