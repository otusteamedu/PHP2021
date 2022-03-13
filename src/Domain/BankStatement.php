<?php

namespace App\Domain;

class BankStatement
{
    private string $dateFrom;
    private string $dateTo;
    private string $email;

    /**
     * @param string $dateFrom
     * @param string $dateto
     * @param string $email
     */
    public function __construct(string $dateFrom, string $dateto, string $email)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateto;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
