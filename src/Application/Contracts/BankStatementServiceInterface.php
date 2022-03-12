<?php

namespace App\Application\Contracts;

use App\Domain\BankStatement;

interface BankStatementServiceInterface
{
    public function generate(BankStatement $statement): void;
}
