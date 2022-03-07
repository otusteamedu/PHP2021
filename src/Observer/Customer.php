<?php

namespace App\Observer;

use SplObserver;
use SplSubject;

class Customer implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo "Клиенту: Готово! Вы можете забрать свой заказ<br/>";
    }
}
