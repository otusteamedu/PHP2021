<?php

namespace App\Observer;

use SplObserver;
use SplSubject;

class Customer implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo "Клиенту: Готово! Вы можете забрать свой заказ<br/>";
    }
}
