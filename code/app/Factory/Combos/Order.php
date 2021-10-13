<?php

namespace App\Factory\Combos;

interface Order
{

    public function __construct(string $name);

    public function getName(): string;

    public function addProduct(ProductBuildInterface $builder);

    public function getProducts(): array;

    public function printOrder();

}