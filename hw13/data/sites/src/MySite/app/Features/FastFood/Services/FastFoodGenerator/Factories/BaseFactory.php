<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories;

use JetBrains\PhpStorm\Pure;
use MySite\app\Features\FastFood\Contracts\FastFoodChangeStatusesContract;
use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;
use MySite\app\Features\FastFood\Contracts\StatusConstants;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools\FactoryTools;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools\SubjectTrait;
use MySite\app\Support\Facades\Logger;
use MySite\app\Support\Iterators\Collection;
use SplSubject;


/**
 * Class BaseFactory
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories
 */
abstract class BaseFactory implements
    FastFoodFactoryContract,
    FastFoodChangeStatusesContract,
    SplSubject
{
    use FactoryTools;
    use SubjectTrait;

    /**
     * @var Collection
     */
    protected Collection $toppings;

    /**
     * @var int
     */
    protected int $status = StatusConstants::NOT_STARTED;

    /**
     * BaseFactory constructor.
     */
    #[Pure] public function __construct()
    {
        $this->toppings = new Collection();
        $this->observers = new Collection();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::getProductNameFromClass(static::class);
    }

    /**
     * @return Collection
     */
    public function getToppings(): Collection
    {
        return $this->toppings;
    }

    /**
     * @inheritDoc
     */
    public function addTopping(string $topping): void
    {
        if ($topping) {
            $this->toppings->addItem($topping);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeTopping(string $topping): void
    {
        $this->toppings->removeItem($topping);
    }

    /**
     * @inheritDoc
     */
    public function addBaseToppings(): void
    {
        $recipe = $this->getRecipeString();
        if ($recipe != "Recipe file not found") {
            $toppings = explode("\n", $recipe);
            $this->toppings->addItems($toppings);
        }
    }

    /**
     * @return bool|string
     */
    private function getRecipeString(): bool|string
    {
        $productName = $this->getName();

        try { 

            $recipe_file_path = __DIR__ . '/../Recipes/' . $productName . '.txt';

            if (!file_exists($recipe_file_path)) {

                throw new Exception("Recipe file not found");

            } 

            return file_get_contents($recipe_file_path);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    /**
     * @inheritDoc
     */
    public function removeBaseToppings(): void
    {
        $this->toppings = new Collection();
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function isReadyForCooking(): void
    {
        $this->setStatus(StatusConstants::READY_FOR_COOKING);
    }

    /**
     * @param int $status
     * @return BaseFactory
     */
    private function setStatus(int $status): BaseFactory
    {
        $this->status = $status;
        $this->notify();
        return $this;
    }

    public function isCooking(): void
    {
        $this->setStatus(StatusConstants::COOKING);
    }

    public function isDone(): void
    {
        $this->setStatus(StatusConstants::DONE);
    }

    public function isFailed(): void
    {
        $this->setStatus(StatusConstants::FAILED);
    }

    /**
     * @inheritDoc
     */
    public function cook(): static
    {
        $this->isCooking();
        Logger::notice('Готовится продукт');
        $this->isDone();
        return $this;
    }

    /**
     * @inheritDoc
     */
    abstract public function pack(): static;

    /**
     * @inheritDoc
     */
    abstract public function addSideDish(): static;
}
