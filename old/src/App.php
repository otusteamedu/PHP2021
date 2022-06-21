<?php

namespace Src;

use Exception;

class App
{
    private const TYPE = 'POST';

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!RequestValidator::isNeedRequestType(self::TYPE)) {
            throw new Exception('Не верный метод запроса');
        }

        if (RequestValidator::isEmpty($_POST)) {
            throw new Exception('Пустой запрос');
        }
    }

    public function run(): void
    {
        try {
            if (Validator::String($_POST['string'])) {
                Response::success();
            } else {
                Response::fail();
            }
        } catch (Exception $e) {
            Response::fail();
        }
    }
}