<?php

declare(strict_types=1);

namespace App\Services;

interface Sender
{

    /**
     * @param array $data
     * @return bool
     */
    public function send(array $data): bool;

}
