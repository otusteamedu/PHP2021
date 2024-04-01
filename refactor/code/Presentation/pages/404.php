<?php

use Presentation\PageBuilder;
use Presentation\PageDirector;

$pageBuilder = new PageBuilder();
$pageDirector = new PageDirector($pageBuilder);

$pageDirector->get404page();
