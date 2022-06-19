<?php

namespace App\Application\Interfaces;

interface StorageInterface
{
  public function insert(string $eventId): string;

  public function searchById(string $eventId): ?string;
  
  public function update(string $eventId, string $status): void;
}
