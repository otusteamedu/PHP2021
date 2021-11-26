<?php

namespace App\Services\RowGateway;

use PDO;
use PDOStatement;

class PatientRow
{
    private ?int $id;
    private ?string $name;
    private ?string $birthday;
    private ?string $phone;
    private ?string $email;
    private ?int $polis;
    private ?int $homeFilial;
    private ?string $description;

    private PDO $pdo;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO patients (name, phone, email) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE patients SET name = ?, phone = ?, email = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM patients WHERE id = ?'
        );
    }


    public function insert(): int
    {
        $this->insertStatement->execute([
            $this->name,
            $this->phone,
            $this->email,
        ]);

        $this->id = (int)$this->pdo->lastInsertId();

        return $this->id;
    }

    public function update(): bool
    {
        return $this->updateStatement->execute([
            $this->name,
            $this->phone,
            $this->email,
            $this->id,
        ]);
    }

    public function delete(): bool
    {
        $result = $this->deleteStatement->execute([$this->id]);

        $this->id = null;

        return $result;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getPolis(): ?int
    {
        return $this->polis;
    }

    /**
     * @param int|null $polis
     */
    public function setPolis(?int $polis): void
    {
        $this->polis = $polis;
    }

    /**
     * @return int|null
     */
    public function getHomeFilial(): ?int
    {
        return $this->homeFilial;
    }

    /**
     * @param int|null $homeFilial
     */
    public function setHomeFilial(?int $homeFilial): void
    {
        $this->homeFilial = $homeFilial;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

}