<?php

namespace Repetitor202\repositories;

interface IOrderRepository
{
    public function setOrderIsPaid(string $orderNumber, float $sum): bool;
}