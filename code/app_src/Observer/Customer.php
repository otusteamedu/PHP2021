<?php

namespace App\Observer;

use SplObserver;
use SplSubject;

class Customer implements SplObserver
{
    private readonly string $customerEmail;
    private $subject;

    public function __construct($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    public function update(SplSubject $subject): void
    {
        $this->subject = $subject;
        $this->sendMessageToClient();
    }

    private function sendMessageToClient()
    {
        /*mail($this->customerEmail, 'Статус заказа изменён!', $this->subject->getStatus());*/
    }
}
