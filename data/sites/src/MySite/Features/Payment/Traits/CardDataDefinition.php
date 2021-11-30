<?php


namespace MySite\Features\Payment\Traits;

use MySite\Http\HttpCodes;

/**
 * Trait CardDataDefinition
 * @package MySite\Features\Payment\Traits
 */
trait CardDataDefinition
{
    /**
     * @var int
     */
    private int $cardNumber;

    /**
     * @var string
     */
    private string $cardHolder;

    /**
     * @var string
     */
    private string $cardExpiration;

    /**
     * @var int
     */
    private int $cvv;

    /**
     * @var string
     */
    private string $order_number;

    /**
     * @var string
     */
    private string $sum;

    /**
     * @var bool
     */
    private bool $isValid = false;

    /**
     * @var null|string
     */
    private ?string $message = null;

    /**
     * @var int
     */
    private int $errorCode = HttpCodes::OK;
}
