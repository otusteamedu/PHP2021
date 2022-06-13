<?php

namespace App\Domain;

class BankStatement
{
    private string $dateFrom;
    private string $dateTo;
    private string $clientId;
    private string $clientMail;

    public function __construct(string $dateFrom, string $dateto, string $clientId, string $clientMail)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateto;
        $this->clientId = $clientId;
        $this->clientMail = $clientMail;
    }

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }
    
    public function getClientId(): string
    {
        return $this->clientId;
    }
    
    public function getClientMail(): string
    {
        return $this->clientMail;
    }
}