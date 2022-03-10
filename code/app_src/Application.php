<?php

namespace App;

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;
use App\Storage\ESStorage;

class Application
{
    private $request;
    private $storageInterface;
    private $appHelper;

    public function __construct()
    {
      try {
        $this->request = RequestValidator::validate($_POST);
      } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
      }

      $this->appHelper = new AppHelper($_POST);
      $this->storageInterface = $this->appHelper->getStorageInterface();
    }

    public function run()
    {
      switch($this->request['action']) {
        case 'Добавить':
          $result = $this->storageInterface->insert($this->request);
          break;

        case 'Удалить':
          $result = $this->storageInterface->deleteAll();
          break;

        case 'Запрос':
          $result = $this->storageInterface->searchEvent($this->request);
          break;

        default:
          throw new \Exception('No action');
          break;
      }

      print_r($result);
    }
}
