<?php

namespace Repetitor202\repositories;

class OrderRepository implements IOrderRepository
{
    public function setOrderIsPaid(string $orderNumber, float $sum): bool
    {
//        return false;
        return true;
    }
}