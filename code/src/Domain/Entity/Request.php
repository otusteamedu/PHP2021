<?php
declare(strict_types=1);

namespace App\Domain\Entity;

//use App\Infrastructure\Components\DataValidation;

class Request
{
    private int $id;
    private string $firstname;
    private string $phone;
    private string $email;
    private string $date1;
    private string $date2;
    private bool $status ;


    public function __construct(
        string $firstname,
        string $email,
        string $phone,
        string $date1,
        string $date2
    )
    {
        //$validate = new DataValidation();

        $this->firstname = $firstname;
        $this->email = $email;
        $this->phone = $phone;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDate1(): string
    {
        return $this->date1;
    }

    public function getDate2(): string
    {
        return $this->date2;
    }

    public function getStatus():bool
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }




}