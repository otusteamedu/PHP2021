<?php

class BaseProduct
{
    protected $cheese = false;

    protected $tomato = false;

    protected $pepper = true;

    protected $salad = true;
    /**
     * @return bool
     */
    public function isTomato(): bool
    {
        return $this->tomato;
    }

    /**
     * @param bool $tomato
     */
    public function setTomato(bool $tomato): void
    {
        $this->tomato = $tomato;
    }

    /**
     * @return bool
     */
    public function isPepper(): bool
    {
        return $this->pepper;
    }

    /**
     * @param bool $pepper
     */
    public function setPepper(bool $pepper): void
    {
        $this->pepper = $pepper;
    }

    /**
     * @return bool
     */
    public function isGreen(): bool
    {
        return $this->green;
    }

    /**
     * @param bool $salad
     */
    public function setGreen(bool $salad): void
    {
        $this->salad = $salad;
    }


    /**
     * @return bool
     */
    public function isCheese(): bool
    {
        return $this->cheese;
    }

    /**
     * @param bool $cheese
     */
    public function setCheese(bool $cheese): void
    {
        $this->cheese = $cheese;
    }
}