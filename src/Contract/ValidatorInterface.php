<?php

namespace App\Contract;

use App\DTO\Request;
use App\DTO\Response;

interface ValidatorInterface
{
    public function validate(Request $req): Response;
}
