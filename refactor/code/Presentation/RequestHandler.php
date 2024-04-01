<?php

namespace Presentation;

use Application\HeroMapper;
use Presentation\Contracts\CharacterMapper;
use Presentation\Contracts\StorageAdapter;

class RequestHandler
{
    private CharacterMapper $storageInterface;

    public function __construct(StorageAdapter $DBAdapter)
    {
        $this->storageInterface = new HeroMapper($DBAdapter);
    }

    public function initAction($request)
    {
        $resultHandler = new ResultHandler();

        switch ($request['action']) {
            case 'add':
                $result = $this->storageInterface->insert($request);

                if (!$result) {
                    throw new \Exception('Ошибка при добавлении данных');
                }

                $resultHandler->runSuccess('Данные успешно добавлены!');

                break;

            case 'search':
                $result = $this->storageInterface->selectByNickname($request['nickname']);
                $resultHandler->runSearch($result);

                break;

            case 'update':
                $result = $this->storageInterface->update($request);

                if (!$result) {
                    throw new \Exception('Ошибка при обновлении данных');
                }

                $resultHandler->runSuccess('Данные успешно обновлены!');

                break;

            case 'delete':
                $result['delete_status'] = $this->storageInterface->deleteById($request['id']);
                $result['action'] = 'delete';

                if (!$result['delete_status']) {
                    throw new \Exception('Ошибка при удалении');
                }

                $resultHandler->runSuccess('Данные успешно удалены!');

                break;

            default:
                throw new \Exception('Действие не задано');
        }

        return $result;
    }

    public function getAll()
    {
        return $this->storageInterface->selectAll();
    }
}
