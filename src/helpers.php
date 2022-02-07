<?php

use App\Infrastructure\Configuration;
use Symfony\Component\Config\Definition\Processor;

function getHTMLTemplate($name) {
    return file_get_contents('../resources/' . $name . '.html');
}

function getConfig($name)
{
    $params = require __DIR__ . '/../config/' . $name . '.php';
    $configs = [$params];
    $processor = new Processor();
    $appConfig = Configuration::getInstance();
    $processedConfiguration = $processor->processConfiguration(
        $appConfig,
        $configs
    );
    return $processedConfiguration;
}
