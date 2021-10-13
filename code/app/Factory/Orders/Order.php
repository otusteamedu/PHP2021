<?php

namespace App\Factory\Orders;

interface Order
{

    /**
     * @param string $name
     */
    public function __construct(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param ProductBuildInterface $builder
     * @return mixed
     */
    public function addProduct(ProductBuildInterface $builder);

    /**
     * @return array
     */
    public function getProducts(): array;

    /**
     * @return mixed
     */
    public function printOrder();

}