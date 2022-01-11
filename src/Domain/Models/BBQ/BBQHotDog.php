<?php

namespace App\Domain\Models\BBQ;

use App\Domain\Models\HotDog;

class BBQHotDog extends HotDog
{
    public $bun = 'BBQBun';
    public $sausage = 'BBQSausage';
    private $receiptFillings = ['Лук', 'Перец'];
}