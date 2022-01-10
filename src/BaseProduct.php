<?php


namespace App;


abstract class BaseProduct implements ProductPrototypeInterface
{
    public $fillings = [];
    private $receiptFillings = [];

    public function getReceiptFilling()
    {
        return $this->receiptFillings;
    }

    public function setReceiptFilling(array $receiptFillings = null)
    {
        if ($receiptFillings) $this->receiptFillings = $receiptFillings;
    }
}