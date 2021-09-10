<?php

namespace AppUnitTests\Repetitor202\repositories;

use PHPUnit\Framework\TestCase;
use Repetitor202\repositories\OrderRepository;

class OrderRepositoryTestCase extends TestCase
{
    public function testSuccess()
    {
        // clean orders
        // INSERT INTO orders(order_number, sum) VALUES (123, 10.50);

        $repository = new OrderRepository();

        static::assertTrue($repository->setOrderIsPaid(123, 10.50));
    }

    public function testUnexistedOrder()
    {
        // clean orders

        $repository = new OrderRepository();

        static::assertFalse($repository->setOrderIsPaid(999, 10.50));
    }
}