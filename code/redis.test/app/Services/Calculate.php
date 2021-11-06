<?php

declare(strict_types=1);

namespace App\Services;

interface Calculate
{

    /**
     * @param array $data
     * @return array
     */
    public function calculate(array $data): array;

    /**
     * @param array $data
     * @return string
     */
    public function calculateAsRow(array $data): string;

}
