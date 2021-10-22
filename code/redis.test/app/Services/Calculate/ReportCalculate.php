<?php

declare(strict_types=1);

namespace App\Services\Calculate;

use App\Services\Calculate;

final class ReportCalculate implements Calculate
{

    private array $result;

    /**
     * @param array $data
     * @return array
     */
    public function calculate(array $data): array
    {

        //Some calculations
        $this->result = [
            'input_params' => $data,
            'data' => [
                'a' => 'result 1',
                'b' => 'result 2',
            ]
        ];

        return $this->result;
    }

    /**
     * @param array $data
     * @return string
     */
    public function calculateAsRow(array $data): string
    {
        return json_encode($this->calculate($data));
    }
}
