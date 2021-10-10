<?php

namespace tests;

use Orders\Data\Order;
use Orders\Data\OrderMapper;
use Orders\Data\Storage\StorageAdapterMysql;
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

    private array $testOrders;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        require_once(__DIR__ . "/../bootstrap/app.php");
        $this->orderMapper = new OrderMapper(new StorageAdapterMysql());

        foreach (self::TEST_ORDERS as $order) {
            $this->testOrders[] = new Order($order['id'], $order['summ'], $order['created_at']);
        }
    }

    public function testSaveNewAndUpdateOld()
    {

        $this->orderMapper->deleteAll();

        $id = $this->testOrders[0]->getId();

        $order = $this->testOrders[0];
        $order = $this->orderMapper->save($order);

        $orderToCheck = $this->orderMapper->findById($id);

        $this->assertEquals($order, $orderToCheck);

        //Проверяем реализацию identity map
        $this->assertSame($order, $orderToCheck);

        $order->setSumm($this->testOrders[1]->getSumm());
        $order->setCreatedAt($this->testOrders[1]->getCreatedAt());

        $this->orderMapper->save($order);

        $orderToCheckUpdate = $this->orderMapper->findById($id);

        $this->assertEquals($order, $orderToCheckUpdate);

        //Проверяем реализацию identity map
        $this->assertSame($order, $orderToCheckUpdate);
    }

    public function testGetAllRecords()
    {
        $this->orderMapper->deleteAll();

        foreach ($this->testOrders as $order) {
            $this->orderMapper->save($order);
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

        $order = $this->testOrders[0];
        $order = $this->orderMapper->save($order);
        $id = $order->getId();

        //Проверяем, что добавилась одна запись
        $records = $this->orderMapper->getAll();
        $this->assertEquals(1, count($records));

        $this->orderMapper->deleteById($id);

        //Проверяем, что эта запись удалена, а следовательно записей - 0
        $recordsAfterDeleteById = $this->orderMapper->getAll();
        $this->assertEmpty($recordsAfterDeleteById);
    }

}