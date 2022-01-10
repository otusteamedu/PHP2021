<?php


namespace App\Application\Visitors;


use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;
use App\Domain\VisitorInterface;

class Visitor implements VisitorInterface
{
    public function visitHotDog(HotDog $hotDog)
    {
        $status = count($hotDog->fillings) / count($hotDog->getReceiptFilling());
        $productName = $hotDog->getName();
        if ($status === 1) {
            echo $productName . ' готов полностью';
        } else {
            echo $productName . ' готов на ' . count($hotDog->fillings) / count($hotDog->getReceiptFilling()) . '<br>';
        }
    }

    public function visitBurger(Burger $burger)
    {
        $status = count($burger->fillings) / count($burger->getReceiptFilling());
        $productName = $burger->getName();
        if ($status === 1) {
            echo $productName . ' готов полностью';
        } else {
            echo $productName . ' готов на ' . count($burger->fillings) / count($burger->getReceiptFilling()) . '<br>';
        }
    }

    public function visitSandwich(Sandwich $sandwich)
    {
        $status = count($sandwich->fillings) / count($sandwich->getReceiptFilling());
        $productName = $sandwich->getName();
        if ($status === 1) {
            echo $productName . ' готов полностью';
        } else {
            echo $productName . ' готов на ' . count($sandwich->fillings) / count($sandwich->getReceiptFilling()) . '<br>';
        }
    }
}