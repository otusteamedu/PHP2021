<?php

namespace App\Application\Interfaces;

interface StorageInterface
{
	public function selectBankStatement(string $dateFrom, string $dateTo, string $clientId);
}
