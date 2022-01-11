<?php


namespace App\Domain\Models\Italian;


use App\Domain\Models\Burger;

class ItalianBurger extends Burger
{
    public $bun = 'ItalianBun';
    public $cutlet = 'ItalianCutlet';
    protected $receiptFillings = ['Лук', 'Перец'];
}