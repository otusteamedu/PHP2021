<?php

declare(strict_types=1);

namespace App\Jobs;

interface WithData
{
    /**
     * @param array $array
     * @return void
     */
    public function setData(array $array): void;

    /**
     * @return array
     */
    public function getData(): array;
}
