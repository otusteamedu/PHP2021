<?php


namespace App\Domain\Models\BBQ;

use App\Domain\Models\Burger;
use App\Domain\VisitorInterface;

class BBQBurger extends Burger
{
    public $bun = 'BBQBurger';
    public $cutlet = 'BBQCutlet';
    private $receiptFillings = ['Лук', 'Перец'];
}