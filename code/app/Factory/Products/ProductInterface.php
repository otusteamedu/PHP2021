<?php

namespace App\Factory\Products;

interface ProductInterface
{

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getElements(): array;

}