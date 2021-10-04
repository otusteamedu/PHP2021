<?php

namespace tests;

use Orders\Data\Order;
use Orders\Data\OrderMapper;
use Orders\Data\Storage\StorageAdapter;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{

    private const TEST_ORDERS = [
        [
            'id' => 1,
            'created_at' => '2021-10-04 01:12:00',
            'summ' => 1000.50,
        ],
        [
            'id' => 2,
            'created_at' => '2021-10-04 10:22:00',
            'summ' => 22050.91,
        ],
        [
            'id' => 3,
            'created_at' => '2021-10-05 15:17:00',
            'summ' => 17750.35,
        ],
        [
            'id' => 4,
            'created_at' => '2021-10-06 19:00:00',
            'summ' => 21000.00,
        ],
    ];

    private OrderMapper $orderMapper;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        require_once(__DIR__ . "/../bootstrap/app.php");
        $this->orderMapper = new OrderMapper(new StorageAdapter());
    }

    public function testSaveNewAndUpdateOld()
    {

        $this->orderMapper->deleteAll();

        $id = self::TEST_ORDERS[0]['id'];

        $order = new Order(self::TEST_ORDERS[0]['summ'], self::TEST_ORDERS[0]['created_at'], $id);
        $order = $this->orderMapper->save($order);

        $orderToCheck = $this->orderMapper->findById($id);

        $this->assertEquals($order, $orderToCheck);

        //Проверяем реализацию identity map
        $this->assertSame($order, $orderToCheck);

        $order->setSumm(self::TEST_ORDERS[1]['summ']);
        $order->setCreatedAt(self::TEST_ORDERS[1]['created_at']);

        $this->orderMapper->save($order);

        $orderToCheckUpdate = $this->orderMapper->findById($id);

        $this->assertEquals($order, $orderToCheckUpdate);

        //Проверяем реализацию identity map
        $this->assertSame($order, $orderToCheckUpdate);
    }

    public function testGetAllRecords()
    {
        $this->orderMapper->deleteAll();

        foreach (self::TEST_ORDERS as $order) {
            $this->orderMapper->save(new Order($order['summ'], $order['created_at']));
        }

        $records = $this->orderMapper->getAll();

        //Проверяем сколько пришло
        $this->assertEquals(count(self::TEST_ORDERS), count($records));
        //Проверяем что пришло
        $this->assertInstanceOf(Order::class, $records[0]);
    }

    public function testDeleteById()
    {
        $this->orderMapper->deleteAll();

        $order = new Order(self::TEST_ORDERS[0]['summ'], self::TEST_ORDERS[0]['created_at']);
        $order = $this->orderMapper->save($order);
        $id = $order->getId();

        //Проверяем, что добавилась одна запись
        $records = $this->orderMapper->getAll();
        $this->assertEquals(1, count($records));

        $this->orderMapper->deleteById($id);

        //Проверяем, что добавилась одна запись
        $recordsAfterDeleteById = $this->orderMapper->getAll();
        $this->assertEmpty($recordsAfterDeleteById);
    }

}