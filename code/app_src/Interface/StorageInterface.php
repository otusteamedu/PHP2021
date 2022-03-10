<?php

namespace App\Interface;

interface StorageInterface
{
  public function insert($arData);

  public function deleteAll();

  public function searchEvent($arData);
}
