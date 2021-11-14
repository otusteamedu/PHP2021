<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:14
 */

namespace app;

use app\components\BracketStringValidate;
use app\services\EmailVerifyService;
use Exception;
use InvalidArgumentException;

/**
 * Class App
 * @package app
 */
class App
{
    /**
     *
     */
    public function run()
    {
        try {
//            $this->bracketStringValidate();
            $this->emailsVerify();

            Response::sendSuccess('OK');
        } catch (InvalidArgumentException $exception) {
            Response::sendBadRequest($exception->getMessage());
        } catch (Exception $exception) {
            Response::sendFailure($exception->getMessage());
        }
    }

    /**
     * POST параметры
     * @return array
     */
    private static function getRequestPostData(): array
    {
        $rawData = file_get_contents("php://input");
        return (array)json_decode($rawData);
    }

    /**
     * Валидирует параметры запроса
     */
    private function bracketStringValidate()
    {
        $params = self::getRequestPostData();

        $form = new BracketStringValidate($params);
        $form->execute();
    }

    /**
     * Верификация Email адресов
     */
    private function emailsVerify()
    {
        $params = self::getRequestPostData();

        $verifyService = EmailVerifyService::fromRequest($params);
        $verifyService->verify();
    }
}