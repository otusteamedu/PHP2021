<?php

namespace App\Interfaces;

use App\Hero;

interface StorageInterface
{
  public function selectById(int $id);

  public function selectAll();

  public function insert(array $arData);

  public function deleteById(int $id);

  public function update(array $arData);
}
