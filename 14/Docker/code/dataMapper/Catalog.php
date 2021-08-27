<?php

namespace hw14\dataMapper;

class Catalog
{
    private int $id;
    private string $name;
    private string $prop1;
    private string $prop2;
    private string $description;
    private int $count;
    private int $price;

    public function __construct(
        int     $id,
        string  $name,
        string  $prop1,
        string  $prop2,
        string  $description,
        int     $count,
        int     $price
    )
    {
        $this->id =             $id;
        $this->name =           $name;
        $this->prop1 =          $prop1;
        $this->prop2 =          $prop2;
        $this->description =    $description;
        $this->count =          $count;
        $this->price =          $price;
    }

    public function setName(string $name):self{
        $this->name = $name;
        return $this;
    }

    public function getName():self{
        return $this->name;
    }

    public function setprop1(string $prop1):self{
        $this->prop1 = $prop1;
        return $this;
    }

    public function getprop1():self{
        return $this->prop1;
    }

    public function setprop2(string $prop2):int{
        $this->prop2 = $prop2;
        return $this;
    }

    public function getprop2():self{
        return $this->prop2;
    }

    public function setId(int $id):int{
        $this->id = $id;
        return $this;
    }

    public function getId():self{
        return $this->id;
    }


    public function setDescription(int $description):string{
        $this->$description = $description;
        return $this;
    }

    public function getDescription():self{
        return $this->description;
    }


    public function setCount(int $count):int{
        $this->$count = $count;
        return $this;
    }

    public function getCount():self{
        return $this->count;
    }

    public function setPrice(int $price):int{
        $this->id = $price;
        return $this;
    }

    public function getPrice():self{
        return $this->price;
    }


}