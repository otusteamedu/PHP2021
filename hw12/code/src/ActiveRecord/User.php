<?php declare(strict_types=1);

namespace App\ActiveRecord;

use PDO;
use PDOStatement;

class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $phone = null;
    private ?string $email = null;
    private PDO $pdo;
    private PDOStatement $selectStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare('SELECT * FROM users');
    }

    public function findCollection()
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute();

        $collection = [];

        while($row = $this->selectStatement->fetch())
        {
            $collection[] = (new self($this->pdo))
                ->setId((int) $row['id'])
                ->setName($row['name'])
                ->setPhone($row['phone'])
                ->setEmail($row['email']);
        }

        return $collection;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
