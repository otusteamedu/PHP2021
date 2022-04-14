<?php

namespace App\Interface;

interface StorageInterface
{
    public function insert($arData);

    public function delete($arData);

    public function search($arData);
}