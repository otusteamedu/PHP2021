<?php

declare(strict_types=1);

namespace App\Modules\Event\Domain\DTO;

use App\Modules\Event\Domain\Contracts\EventDTOInterface;

class SearchEventDTO implements EventDTOInterface
{
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
