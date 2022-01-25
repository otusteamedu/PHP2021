<?php

namespace App\Product\Validate;

use App\Product\Validate\Parameters\Comparison;
use App\Product\Validate\Parameters\Emptiness;

class Validate
{
    private $comparison;
    private $countMissingParameters;
    private $missingParameters;
    private $message;
    private $emptiness;
    private $countMissingValue;
    private $missingValue;
    private $result;
    
    public function Validate(array $inputParameters, array $columnsInTable) :array
    {

        $this->comparison = (new Comparison())->Comparison($inputParameters, $columnsInTable);

        if (!$this->comparison) {

            $this->emptiness = (new Emptiness())->Emptiness($inputParameters);

            if (!$this->emptiness) {

                $this->result = [];

            } else {

                $this->countMissingValue = count($this->emptiness);

                if ($this->countMissingValue > 1) {
                    $this->message = 'Пустые параметры: ';
                } else {
                    $this->message = 'Пустой параметр: ';
                }

                $this->missingValue = implode(", ", $this->emptiness);

                $this->result = [
                    'code' => '400',
                    'message' => 'Неверно указаны параметры. ' . $this->message . '' . $this->missingValue . ''
                ];

            }

        } else {

            $this->countMissingParameters = count($this->comparison);

            if ($this->countMissingParameters > 1) {
                $this->message = 'Отсутсвуют параметры: ';
            } else {
                $this->message = 'Отсутсвует парамет: ';
            }

            $this->missingParameters = implode(", ", $this->comparison);

            $this->result = [
                'code' => '400',
                'message' => 'Неверно указаны параметры. ' . $this->message . '' . $this->missingParameters . ''
            ];
        }
        
        return $this->result;
        
    }
}