<?php

namespace App\Product\Validate\Parameters;

class Emptiness
{
    private array $data;
    private array $emptinessParameters = [];

    public function Emptiness(array $data) :array
    {
        $this->data = $data;

        foreach ($this->data as $parameter => $value) {

            if (empty($value)) {

                $this->emptinessParameters[] = $parameter;

            }

        }
        
        return $this->emptinessParameters;
    }

}