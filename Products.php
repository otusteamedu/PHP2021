<?php

use PDO;
use PDOStatement;

use ProductOptions;

class Product {

    private $pdo;
    private $selectStatement;
    private $insertStatement;
    private $updateStatement;
    private $deleteStatement;

    private $productOption = null;

    public function __construct(PDO $pdo){

        $this->pdo = $pdo;

        $this->selectStatement = $pdo->prepare(
            "SELECT * FROM products WHERE id = ?"
        );

        $this->insertStatement = $pdo->prepare(
            "INSERT INTO products (productName, weight, price) VALUES (?, ?, ?)"
        );

        $this->updateStatement = $pdo->prepare(
            "UPDATE products SET productName = ?, weight = ?, price = ? WHERE id = ?"
        );

        $this->deleteStatement = $pdo->prepare(
            "DELETE FROM products WHERE id = ?"
        );

    }


    public function getOneById(int $id) : Array 
    {
        $this->selectStatement->execute([$id]);
        return $this->selectStatement->fetch(PDO::FETCH_ASSOC);
    }


    public function insert(String $productName, Int $weight, Int $price) : Int 
    {
        $this->insertStatement->execute(
            $productName,
            $weight,
            $price
        );

        return $this->pdo->lastInsertId();
    }
    

    public function update(Integer $id, String $productName, Int $weight, Int $price) : Bool 
    {
        return $this->updateStatement->execute([
            $productName,
            $weight,
            $price,
            $id
        ]);
    }


    public function delete(Int $id) : Bool 
    {
        return $this->deleteStatement->execute([$id]);
    }


    public function getProductPtions(Int $id) : Array
    {
        if(is_null($this->productOption)){
            $this->productOption = ProductOptions::getOptions($id);
        }

        return $this->productOption;
    }

}