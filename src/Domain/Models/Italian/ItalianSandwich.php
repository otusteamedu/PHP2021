<?php

namespace App\Domain\Models\Italian;

use App\Domain\Models\Sandwich;

class ItalianSandwich extends Sandwich
{
    public $bun = 'ItalianBun';
    public $cheese = 'ItalianCheese';
    protected $receiptFillings = ['Лук', 'Перец'];
}