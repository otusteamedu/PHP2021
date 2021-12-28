<?php

namespace App\Jobs;

interface BankStatementInterface
{
    public function getEmail(): string;

    public function setEmail(string $email): void;

}
