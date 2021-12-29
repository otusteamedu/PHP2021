<?php


namespace MySite\app\Features\FastFood\Contracts;

use Attribute;
use MySite\app\Support\Iterators\Collection;

/**
 * Interface FastFoodFactoryContract
 * @package MySite\app\Features\FastFood\Contracts
 */
#[Attribute]
interface FastFoodFactoryContract
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param string $topping
     */
    public function addTopping(string $topping): void;

    /**
     * @return Collection
     */
    public function getToppings(): Collection;

    /**
     * @param string $topping
     */
    public function removeTopping(string $topping): void;

    /**
     * Добавляет ингредиенты из файла рецепта
     * @return void
     */
    public function addBaseToppings(): void;

    /**
     * Удаляет ингредиенты из файла рецепта
     * @return void
     */
    public function removeBaseToppings(): void;

    /**
     * Приготовить продукт
     *
     * @return $this
     */
    public function cook(): static;

    /**
     * Упаковывает продукт
     *
     * @return $this
     */
    public function pack(): static;

    /**
     * Добавить закуску
     *
     * @return $this
     */
    public function addSideDish(): static;
}
