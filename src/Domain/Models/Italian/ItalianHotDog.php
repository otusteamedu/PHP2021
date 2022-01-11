<?php

namespace App\Domain\Models\Italian;

use App\Domain\Models\HotDog;

class ItalianHotDog extends HotDog
{
    public $bun = 'ItalianBun';
    public $sausage = 'ItalianSausage';
    protected $receiptFillings = ['Лук', 'Перец'];

}