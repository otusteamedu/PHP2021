<?php

namespace App\Application\Contracts;

interface BankStatementServiceInterface
{
    public function execute(string $req): void;
}
