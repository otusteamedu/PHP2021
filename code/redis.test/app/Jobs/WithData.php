<?php

declare(strict_types=1);

namespace App\Jobs;

interface WithData
{

    /**
     * @param array $array
     * @return mixed
     */
    public function setData(array $array);

    /**
     * @return array
     */
    public function getData(): array;

}
