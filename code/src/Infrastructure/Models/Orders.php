<?php
declare(strict_types=1);

namespace App\Infrastructure\Models;


use PDO;
use PDOStatement;
use App\System\DB;
use App\Infrastructure\Components\Order;

class Orders
{
    private PDO $pdo;
    private PDOStatement $selectStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;


    public function __construct(){
        $this->pdo = (new DB())->getInstance()->connectDB();
        //$this->pdo =(new DB())->getPDO();

        $this->selectStatement = $this->pdo->prepare(
            'SELECT * FROM orders WHERE order_number=? AND sum_order=?'
        );
        $this->insertStatement =$this->pdo->prepare(
            'INSERT INTO orders (card_number, card_holder, card_expiration, cvv, order_number,sum_order) VALUES (?, ?, ?, ?, ?, ?)'
        );

        $this->updateStatement = $this->pdo->prepare(
            'UPDATE orders SET first_name = ?, last_name = ?, age =?, email = ?, status_student = ? WHERE id = ?'
        );
        $this->deleteStatement = $this->pdo->prepare(
            'DELETE FROM orders WHERE id = ?'
        );


    }


    public function insertNewOrder(Order $object) : Order
    {
        $this->insertStatement->execute([
            $object->getCardNumber(),
            $object->getCardHolder(),
            $object->getCardExpiration(),
            (int)$object->getCvv(),
            $object->getOrderNumber(),
            (float)$object->getSum()
        ]);

        return new Order(
            (int)$this->pdo->lastInsertId(),
            $object->getCardNumber(),
            $object->getCardHolder(),
            $object->getCardExpiration(),
            $object->getCvv(),
            $object->getOrderNumber(),
            $object->getSum()
        );
    }

    public function selectOrderIsPaid(string $orderNumber, float $sum) : bool
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$orderNumber,$sum]);

        $result = $this->selectStatement->fetch();

        if(!$result) throw new \PDOException('Код состоит из 3 цифр от 0 до 9');

        return true;
    }

    public function deleteOrder(Order $order) : bool
    {
        return $this->deleteStatement->execute([$order->getId()]);
    }

}