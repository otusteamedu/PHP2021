<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:14
 */

namespace app;

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
            $this->validateRequestParams();

            Response::sendSuccess('OK');
        } catch (InvalidArgumentException $exception) {
            Response::sendBadRequest($exception->getMessage());
        } catch (Exception $exception) {
            Response::sendFailure($exception->getMessage());
        }
    }

    /**
     * Валидирует параметры запроса
     */
    private function validateRequestParams()
    {
        $rawData = file_get_contents("php://input");
        $params = (array)json_decode($rawData);

        $form = new StringValidateForm($params);
        $form->execute();
    }
}