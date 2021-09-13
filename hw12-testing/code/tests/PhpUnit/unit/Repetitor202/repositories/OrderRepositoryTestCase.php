<?php

namespace PhpUnit\unit\Repetitor202\repositories;

use PHPUnit\Framework\TestCase;
use Repetitor202\repositories\OrderRepository;

// как я понял из задания, перед проведением платежа в базе уже дожна быть запись с соответствующим ордером
// (должен совпадать набор полей: order_number, sum)

class OrderRepositoryTestCase extends TestCase
{
    public function testSuccess()
    {
        static::markTestIncomplete('Недоделанный тест');
        // clean orders
        // INSERT INTO orders(order_number, sum) VALUES (123, 10.50);

        $repository = new OrderRepository();

        static::assertTrue($repository->setOrderIsPaid(123, 10.50));
    }

    public function testUnexistedOrder()
    {
        static::markTestIncomplete('Недоделанный тест');
        // clean orders

        $repository = new OrderRepository();

        static::assertFalse($repository->setOrderIsPaid(999, 10.50));
    }
}