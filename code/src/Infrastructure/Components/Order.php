<?php
declare(strict_types=1);

namespace App\Infrastructure\Components;

class Order
{
    private int $id;
    private string $cardNumber;
    private string $cardHolder;
    private string $cardExpiration;
    private string $cvv;
    private string $orderNumber;
    private string $sum;

    /**
     * @param int $id
     * @param string $cardNumber
     * @param string $cardHolder
     * @param string $cardExpiration
     * @param string $cvv
     * @param string $orderNumber
     * @param string $sum
     */
    public function __construct(
        int $id,
        string $cardNumber,
        string $cardHolder,
        string $cardExpiration,
        string $cvv,
        string $orderNumber,
        string $sum)
    {
        $this->id = $id;
        $this->cardNumber = $cardNumber;
        $this->cardHolder = $cardHolder;
        $this->cardExpiration = $cardExpiration;
        $this->cvv = $cvv;
        $this->orderNumber = $orderNumber;
        $this->sum = $sum;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getCardHolder(): string
    {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     */
    public function setCardHolder(string $cardHolder): void
    {
        $this->cardHolder = $cardHolder;
    }

    /**
     * @return string
     */
    public function getCardExpiration(): string
    {
        return $this->cardExpiration;
    }

    /**
     * @param string $cardExpiration
     */
    public function setCardExpiration(string $cardExpiration): void
    {
        $this->cardExpiration = $cardExpiration;
    }

    /**
     * @return int
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     */
    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber(string $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getSum(): string
    {
        return $this->sum;
    }

    /**
     * @param string $sum
     */
    public function setSum(string $sum): void
    {
        $this->sum = $sum;
    }


}