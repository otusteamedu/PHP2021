<?php

namespace Repetitor202\facades;

use Repetitor202\dto\StatusMessageDto;

class MoneyServiceAFacade
{
    public function pay(array $params): StatusMessageDto
    {
        $statusMessageDto = new StatusMessageDto();

//        // if unsuccess
//        $statusMessageDto->setStatus('403');
//        $statusMessageDto->setMessage('Не получилось списать деньги!!!');

        return $statusMessageDto;
    }
}