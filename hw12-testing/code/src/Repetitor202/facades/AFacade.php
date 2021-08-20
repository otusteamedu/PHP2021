<?php

namespace Repetitor202\facades;

use Repetitor202\dto\StatusMessageDto;

class AFacade
{
    public function pay(array $params): StatusMessageDto
    {
        return (new StatusMessageDto());
    }
}