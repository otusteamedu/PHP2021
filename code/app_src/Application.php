<?php

namespace App;

require 'vendor/autoload.php';

class Application
{
    private $request;
    private $storageInterface;
    private $appHelper;

    public function __construct()
    {
        $this->appHelper = new StorageFactory();
        $this->storageInterface = $this->appHelper->getStorageInterface($_POST);
        $this->request = $_POST;
    }

    public function run()
    {
        switch ($this->request['action']) {
            case 'add':
                $result = $this->storageInterface->insert($this->request);

                break;

            case 'delete':
                $result = $this->storageInterface->deleteAll();
                break;

            case 'search':
                $result = $this->storageInterface->searchEvent($this->request);

                break;

            default:
                throw new \Exception('Десйствие не определено');

                break;
        }

        return $result;
    }

    public function handleResult($result)
    {
        switch ($result['action']) {
            case 'add':
                $title = 'Данные добавлены!';
                include_once 'views/success.php';

                break;

            case 'search':
                $title = 'Кое-что нашлось';
                include_once 'views/search.php';

                break;

            case 'delete':
                $title = 'Данные удалены';

                include_once 'views/delete.php';

                break;

            case 'empty':
                $title = 'Ничего не найдено';

                include_once 'views/empty.php';

                break;

            default:
                throw new \Exception('Данные обработаны неверно');
        }

    }
}
