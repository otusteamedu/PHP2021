<?php declare(strict_types=1);

namespace App\DataMapper;

class User
{
    private int $id;
    private string $name;
    private string $phone;
    private string $email;

    public function __construct(
        int $id,
        string $name,
        string $phone,
        string $email
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
