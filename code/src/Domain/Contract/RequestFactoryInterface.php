<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Domain\Entity\Request;

interface RequestFactoryInterface
{
    public function build(
        string $firstname,
        string $email,
        string $phone,
        string $date1,
        string $date2
    ):Request;
}