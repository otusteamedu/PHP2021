<?php
namespace App\source;

class emailSource
{
    private $resource;

    public function setResource($resource){
        $this->resource = $resource;
    }

    public function getResource(){
       return $this->resource;
    }
}