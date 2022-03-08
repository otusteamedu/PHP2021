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
        $this->request = $_POST;
        $this->ElasticSearchInterface = new ESStorage();
        $this->appHelper = new AppHelper($this->request);
        $this->statisticsManager = new StatisticsManager($this->ElasticSearchInterface);
    }

    public function run()
    {
        $arData = $this->appHelper->getRequestBody();
        switch($this->request['tab-btn']) {
          case 'add':
            $result = $this->ElasticSearchInterface->insert($arData);
            break;

          case 'delete':
            $result = $this->ElasticSearchInterface->delete($arData);
            break;

          case 'info':
            $result = $this->statisticsManager->getChannelSummary($arData['id']);
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
