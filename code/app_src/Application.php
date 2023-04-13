<?php

namespace App;

require 'vendor/autoload.php';

use App\Storage\ESStorage;

class Application
{
    private $request;
    private $ElasticSearchInterface;

    public function __construct()
    {
        $this->ElasticSearchInterface = new ESStorage();
        $this->statisticsManager = new StatisticsManager($this->ElasticSearchInterface);
        $this->request = $_POST;
    }

    public function run()
    {
        switch ($this->request['action']) {
            case 'add':
                $result = $this->ElasticSearchInterface->insert($this->request);

                break;

            case 'search':
                $result = $this->statisticsManager->getSummary($this->request);
                $result['action'] = 'search';

                break;

            default:
                throw new \Exception('Empty request');

                break;
        }

        return $result;
    }

    public function getTopChannels()
    {
        return $this->statisticsManager->getTopRatedChannels();
    }

    public function getAllEsEntitys()
    {
        $arAllChannels = $this->statisticsManager->getAllChannels();
        $arAll = [];

        foreach ($arAllChannels as $channel) {
            $allChannelVideos = $this->statisticsManager->getAllChanelVideos($channel['_id']);
            $arAll[$channel['_id']] = [
                'name' => $channel['_source']['channel_name'],
                'index' => $channel['_index'],
                'videos' => $allChannelVideos
            ];
        }

        return $arAll;
    }

    public function delete($data)
    {
        return $this->ElasticSearchInterface->delete($data);
    }
}
