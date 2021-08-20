<?php

namespace Repetitor202\validators\payment;

use Repetitor202\dto\ValidatorResultDto;

interface IMakePaymentValidator
{
    public function validate(?array $params): ValidatorResultDto;
}