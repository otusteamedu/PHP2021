<?php

namespace App;

use App\Storage\HeroMapper;
use App\Adapters\DBAdapter;

class Application
{
    private $request;
    private $storageInterface;

    public function __construct()
    {
        $this->request = $_POST;

        $DBAdapter = new DBAdapter();
        $this->storageInterface = new HeroMapper($DBAdapter);
    }

    public function run()
    {
        if (!isset($_POST['action'])) {
            $_POST['action'] = $_GET['action'];
        }

        switch ($_POST['action']) {
            case 'add':
                $result['data'] = $this->storageInterface->insert($_POST);
                $result['action'] = 'add';

                break;

            case 'search':
                $result['data'] = $this->storageInterface->selectByNickname($_POST['nickname']);
                $result['action'] = 'search';

                break;

            case 'update':
                $result = $this->storageInterface->update($_POST);

                break;

            case 'delete':
                $result['delete_status'] = $this->storageInterface->deleteById($_GET['id']);
                $result['action'] = 'delete';

                if (!$result['delete_status']) {
                    throw new \Exception('Ошибка при удалении');
                }

                break;

            default:
                throw new \Exception('Действие не задано');
        }

        return $result;
    }

    public function resultHandler($result)
    {
        switch ($result['action']) {
            case 'add':
                $title = 'Данные успешно добавлены!';

                require_once 'pages/success.php';

                break;

            case 'search':
                $hero = $result['data'];

                require_once 'pages/search.php';

                break;

            case 'updated':
                $title = 'Данные успешно обновлены!';

                require_once 'pages/success.php';

                break;

            case 'delete':
                $title = 'Данные успешно удалены!';

                require_once 'pages/success.php';
        }
    }

    public function showAll()
    {
        return $this->storageInterface->selectAll();
    }
}
