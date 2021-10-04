<?php

declare(strict_types=1);

namespace Orders\Data;

use Orders\Data\Storage\StorageAdapter;

final class OrderMapper
{

    private const TABLE_NAME = "orders";

    /**
     * @var array
     */
    private array $identities = [];

    /**
     * @var StorageAdapter
     */
    private StorageAdapter $storageAdapter;

    /**
     * @param StorageAdapter $storageAdapter
     */
    public function __construct(StorageAdapter $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    /**
     * @param int $id
     * @return Order|null
     */
    public function findById(int $id): ?Order
    {
        if (!array_key_exists($id, $this->identities)) {
            $this->identities[$id] = null;
            $orderArray = $this->storageAdapter->getDataById($id, self::TABLE_NAME);

            if ($orderArray !== null) {
                $this->identities[$id] = self::mapArrayToOrder($orderArray);
            }
        }
        return $this->identities[$id];
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $ordersAsArrays = $this->storageAdapter->getAll(self::TABLE_NAME);

        if (empty($ordersAsArrays)) {
            return [];
        }


        return array_map(function (array $row) {
            if (!array_key_exists($row['id'], $this->identities)) {
                return $this->identities[$row['id']];
            }

            return self::mapArrayToOrder($row);
        }, $ordersAsArrays);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        unset($this->identities[$id]);
        return $this->storageAdapter->deleteById($id, self::TABLE_NAME);
    }

    /**
     * @return bool
     */
    public function deleteAll(): bool
    {
        $this->identities = [];
        return $this->storageAdapter->deleteAll(self::TABLE_NAME);
    }

    /**
     * @param Order $order
     * @return Order
     */
    public function save(Order $order): Order
    {
        $result = $this->storageAdapter->saveData($order->asArray(), self::TABLE_NAME);

        $order->getId() ?? $order->setId($result);

        $id = $order->getId();
        $this->identities[$id] = $order;

        return $this->identities[$id];
    }

    /**
     * @param array $row
     * @return Order
     */
    private static function mapArrayToOrder(array $row): Order
    {
        return Order::fromState($row);
    }

}