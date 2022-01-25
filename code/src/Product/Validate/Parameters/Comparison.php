<?php

namespace App\Product\Validate\Parameters;

class Comparison
{
    private array $inputParameters;
    private array $parameters;
    private array $columnsInTable;
    private array $missingParameter;

    public function Comparison(array $inputParameters, array $columnsInTable) :array
    {
        $this->inputParameters = $inputParameters;
        $this->columnsInTable = $columnsInTable;
        
        if ($this->inputParameters) {

            foreach ($this->inputParameters as $key => $value) {
                $this->parameters[] = $key;
            }

        } else {

            $this->parameters = [];

        }

        

        $this->missingParameter = array_diff($this->columnsInTable, $this->parameters);

        return $this->missingParameter;
    }
}