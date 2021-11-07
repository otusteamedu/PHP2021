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
     * App constructor.
     */
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    /**
     *
     */
    public function run()
    {
        try {
            http_response_code(200);

            $response = $this->getValidateFormResponse();
        } catch (InvalidArgumentException $exception) {
            http_response_code(400);

            $response = [
                'message' => $exception->getMessage(),
            ];
        } catch (Exception $exception) {
            http_response_code(500);

            $response = [
                'message' => $exception->getMessage(),
            ];
        }

        $this->renderResponse($response);
    }

    /**
     * Ответ от формы валидации
     * @return array
     */
    private function getValidateFormResponse(): array
    {
        $rawData = file_get_contents("php://input");
        $params = (array)json_decode($rawData);

        $form = new StringValidateForm($params);
        return $form->execute();
    }

    /**
     * @param array $response
     */
    private function renderResponse(array $response)
    {
        $response = array_merge($response, [
            'status' => http_response_code(),
        ]);

        echo json_encode($response);
    }
}