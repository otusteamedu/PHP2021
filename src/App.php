<?php
namespace Otus;

class App
{

    private String $name;

    public function __construct(String $name) {
        $this->name = $name;
    }

    public function showName() {
        echo $this->name;
    }

}
