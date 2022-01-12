<?php

namespace App\Domain\Models\BBQ;

use App\Domain\Models\Sandwich;

class BBQSandwich extends Sandwich
{
    public $bun = 'BBQBun';
    public $cheese = 'BBQCheese';
    private $receiptFillings = ['Лук', 'Перец'];
}