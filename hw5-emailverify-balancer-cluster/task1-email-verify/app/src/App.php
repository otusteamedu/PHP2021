<?php

namespace App;

use Repetitor202\Email\ReportFactory;
use Repetitor202\FileParser;
use Symfony\Component\Yaml\Yaml;


class App
{
    public function run(): void
    {
        $emails = (new FileParser())->getLines($_SERVER['argv'][1]);
        $config = Yaml::parseFile(__DIR__ . '/../config/email.yaml');

        $emailReport = new ReportFactory();
        $emailReport->setValidators($config['validators']);
        $emailReport->validateList($emails);
    }
}