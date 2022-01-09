<?php

declare(strict_types=1);

namespace Vasechkin\DataMapper;

use PDO;
use PDOStatement;

class UserMapper
{
    /** @var  PDO  $pdo */
    private $pdo;

    /** @var  PDOStatement  $selectManyStatement */
    private $selectManyStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectManyStatement = $pdo->prepare(
            implode(PHP_EOL, [
                'select',
                '     t.id   as id',
                '    ,t.code as code',
                '    ,t.name as name',
                '  from manufacturer as t',
                ';'
            ])
        );
    }

    /**
     * @return Manufacturer[]
     */
    public function findAll(): array
    {
        $this->selectManyStatement->execute();

        $resultSet = $this->selectManyStatement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($resultSet as $row) {
            $result[] = new Manufacturer(
                $row['id'],
                $row['code'],
                $row['name']
            );
        }

        return $result;
    }
}
