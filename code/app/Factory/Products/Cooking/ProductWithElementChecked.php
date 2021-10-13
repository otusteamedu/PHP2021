<?php

declare(strict_types=1);

namespace App\Factory\Products\Cooking;

use App\Factory\Products\Cooking\Base\Observer;
use App\Factory\Products\Cooking\Base\ProductDecorator;
use App\Factory\Products\Cooking\Base\ProductToCookInterface;

final class ProductWithElementChecked extends Observer implements ProductToCookInterface
{

    private const MIN_ELEMENTS = 5;

    private string $status;

    public function __construct(private ?ProductDecorator $product)
    {
        parent::__construct();
        $this->status = StatusList::STATUS_WAITING;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return !is_null($this->product) ? $this->product->getName() : '';
    }

    /**
     * @inheritDoc
     */
    public function getElements(): array
    {
        return !is_null($this->product) ? $this->product->getElements() : [];
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    private function cook()
    {
        if (count($this->getElements()) >= self::MIN_ELEMENTS) {
            $this->status = StatusList::STATUS_IN_PROGRESS;
            $this->notify();
        }
    }

    private function finish()
    {
        if ($this->status != StatusList::STATUS_IN_PROGRESS) {
            return;
        }

        if ($this->checkProduct()) {
            $this->status = StatusList::STATUS_FINISHED;
            $this->notify();
        } else {
            $this->product = null;
        }
    }

    private function checkProduct(): bool
    {
        $condition = rand(0, 2) % 2 == 0;
        echo "condition = " . $condition . PHP_EOL;
        return $condition;
    }

    public function create(): bool
    {
        $this->cook();
        $this->finish();

        if ($this->status == StatusList::STATUS_FINISHED) {
            $this->status = StatusList::STATUS_DELIVERED;
            return true;
        }
        return false;
    }
}
