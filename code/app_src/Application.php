<?php

namespace App;

require 'vendor/autoload.php';

use App\Storage\HeroMapper;

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

      $this->appHelper = new AppHelper;
      $this->storageInterface = new HeroMapper($this->appHelper->createConnection());
    }

    public function run()
    {
      switch($this->request['action']) {
        case 'Insert':
          $result = $this->storageInterface->insert($this->request);
          break;

        case 'Select':
          $result = $this->storageInterface->selectById($this->request['id']);
          break;

        case 'Select All':
          $result = $this->storageInterface->selectAll();
          break;

        case 'Update':
          $result = $this->storageInterface->update($this->request);
          break;

        case 'Delete':
          $result = $this->storageInterface->deleteById($this->request['id']);
          break;

        default:
          throw new \Exception('No action');
          break;
      }

      print_r($result);
    }
}
