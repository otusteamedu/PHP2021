<?php

namespace App\Infrastructure;

use App\Domain\BankStatement;
use App\Application\Interfaces\BankServiceInterface;

class BankService implements BankServiceInterface
{
	
	private BankStatement $bankStatement;
	
	public function setBankStatement(string $userData)
	{
		$body = json_decode($userData, true);
		
        if (is_null($body)) {
            throw new Exception('Empty user data');
        }

        $this->bankStatement = new BankStatement(
        	$body['date_from'],
        	$body['date_to'],
        	$body['client_id'],
        	$body['client_email']
        );
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
