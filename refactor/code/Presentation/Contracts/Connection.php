<?php

namespace Presentation\Contracts;

use PDO;

interface Connection
{
    public function createConnection(): PDO;
}
