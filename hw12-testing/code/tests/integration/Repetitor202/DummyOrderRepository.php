<?php

namespace integration\Repetitor202;

use Repetitor202\repositories\IOrderRepository;

class DummyOrderRepository implements IOrderRepository
{
    public function setOrderIsPaid(string $orderNumber, float $sum): bool
    {
        return true;
    }
}