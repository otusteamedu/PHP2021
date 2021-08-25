<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use MySite\app\Support\Facades\Schema;

$entityManager = Schema::connection();
return ConsoleRunner::createHelperSet($entityManager);
