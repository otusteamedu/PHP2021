<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Dto;

use MySite\Features\Payment\Traits\CardDataDefinition;

/**
 * Class CardData
 * @package MySite\Features\Payment\Dto
 */
class CardData
{
    /**
     * @param array $data
     * @return CardData
     */
    public static function createFromArray(array $data): CardData
    {
        return (new self())
            ->setCardNumber($data['card_number'])
            ->setCardHolder($data['card_holder'])
            ->setCardExpiration($data['card_expiration'])
            ->setCvv($data['cvv'])
            ->setOrderNumber($data['order_number'])
            ->setSum($data['sum']);
    }

    /**
     * @param string $sum
     * @return CardData
     */
    public function setSum(string $sum): CardData
    {
        $this->sum = $sum;
        return $this;
    }

    use CardDataDefinition;

    /**
     * @param string $order_number
     * @return CardData
     */
    public function setOrderNumber(string $order_number): CardData
    {
        $this->order_number = $order_number;
        return $this;
    }

    /**
     * @param int $cvv
     * @return CardData
     */
    public function setCvv(int $cvv): CardData
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @param string $cardExpiration
     * @return CardData
     */
    public function setCardExpiration(string $cardExpiration): CardData
    {
        $this->cardExpiration = $cardExpiration;
        return $this;
    }

    /**
     * @param string $cardHolder
     * @return CardData
     */
    public function setCardHolder(string $cardHolder): CardData
    {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @param int $cardNumber
     * @return CardData
     */
    public function setCardNumber(mixed $cardNumber): CardData
    {
        $this->cardNumber = (int) $cardNumber;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     * @return CardData
     */
    public function setErrorCode(int $errorCode): CardData
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @param null|string $message
     * @return CardData
     */
    public function setMessage(?string $message): CardData
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     * @return CardData
     */
    public function setIsValid(bool $isValid): CardData
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * @return int
     */
    public function getCardNumber(): int
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getCardHolder(): string
    {
        return $this->cardHolder;
    }

    /**
     * @return string
     */
    public function getCardExpiration(): string
    {
        return $this->cardExpiration;
    }

    /**
     * @return int
     */
    public function getCvv(): int
    {
        return $this->cvv;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->order_number;
    }

    /**
     * @return string
     */
    public function getSum(): string
    {
        return $this->sum;
    }

}
