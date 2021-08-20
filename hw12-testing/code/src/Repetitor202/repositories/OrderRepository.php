<?php

namespace Repetitor202\repositories;

class OrderRepository
{
    public function setOrderIsPaid(string $orderNumber, float $sum): bool
    {
        return true;
    }
}