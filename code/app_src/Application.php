<?php

namespace App;

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;
use App\Storage\ESStorage;

class Application
{
    private $request;
    private $ElasticSearchInterface;
    private $appHelper;

    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('Wrong request method');
        }
        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('Empty request');
        }

        $this->ElasticSearchInterface = new ESStorage();
        $this->statisticsManager = new StatisticsManager($this->ElasticSearchInterface);

        if (!RequestValidator::checkMainFields($_POST, $this->ElasticSearchInterface)) {
            throw new \Exception('Main fields missing or empty');
        }

        $this->request = $_POST;
    }

    public function run()
    {
        switch($this->request['tab-btn']) {
            case 'add':
                $result = $this->ElasticSearchInterface->insert($this->request);
                break;

            case 'delete':
                $result = $this->ElasticSearchInterface->delete($this->request);
                break;

            case 'info':
                $result = $this->statisticsManager->getChannelSummary($this->request['id']);
                break;

            case 'top':
                $result = $this->statisticsManager->getTopRatedChannels();
                break;

            default:
                throw new \Exception('Empty request');
                break;
        }

        print_r($result);
    }
}