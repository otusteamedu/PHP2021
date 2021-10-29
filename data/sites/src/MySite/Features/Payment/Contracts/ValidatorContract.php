<?php


namespace MySite\Features\Payment\Contracts;


use MySite\Features\Payment\Dto\CardData;

/**
 * Interface ValidatorContract
 * @package MySite\Features\Payment\Contracts
 */
interface ValidatorContract
{
    /**
     * @param string $validator
     * @return ValidatorContract
     */
    public function add(string $validator): ValidatorContract;

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData;
}
