<?php

namespace App\Infrastructure;

use App\Domain\BankStatement;
use App\Application\Interfaces\BankServiceInterface;

class BankService implements BankServiceInterface
{
	
	private BankStatement $bankStatement;
	private array $requiredStatementFields = [
		 'date_from',
		 'date_to',
		 'client_id',
		 'client_email',
	];
	
	public function setBankStatement(string $userData): void
	{
		$statement = json_decode($userData, true);
		
        if ($this->validateStatementData($statement)) {
            throw new Exception('Not enough data for request');
        }

        $this->bankStatement = new BankStatement(
        	$statement['date_from'],
        	$statement['date_to'],
        	$statement['client_id'],
        	$statement['client_email']
        );
	}

	public function validateStatementData(array $data): bool
	{
		if (is_null($data)) {
			return false;
		}
		
		foreach ($this->requiredStatementFields as $field){
			if (!in_array($field, $data)) {
				return false;
			}
		}
		
		return true;
	}

	public function getUserData(): array
	{
		if (isset($this->bankStatement)) {
			//некоторая выборка данных за указанный пользователем период
			$someClientInfo = range(0,100);
			shuffle($someClientInfo);
			return [
				'client_mail' => $this->bankStatement->getClientMail(),
				'client_info' => json_encode($someClientInfo)
			];
		} else {
			throw new Exception('Empty statement');
		}
	}
}
