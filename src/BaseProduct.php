<?php


namespace App;


abstract class BaseProduct implements ProductPrototypeInterface
{
    public $filling = [];
    private $receiptFillings = [];

    public function getReceiptFilling()
    {
        return $this->receiptFillings;
    }

    public function setReceiptFilling($receiptFillings)
    {
        $this->receiptFillings = $receiptFillings;
    }
}