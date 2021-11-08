<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 08.11.2021
 * Time: 11:39
 */

namespace app;

/**
 * Ответ от сервера
 *
 * Class Response
 * @package app
 */
class Response
{
    public const CODE_SUCCESS = 200;
    public const CODE_BAD_REQUEST = 400;
    public const CODE_FAILURE_SERVER = 500;

    /**
     * @var int Код ответа
     */
    private int $code;
    /**
     * @var string Текст ответа
     */
    private string $message;

    /**
     * Response constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Отправялет успешный ответ от сервера
     * @param string $message
     */
    public static function sendSuccess(string $message)
    {
        $instance = new self(self::CODE_SUCCESS, $message);
        $instance->send();
    }

    /**
     * Оштбка валидации данных
     * @param string $message
     */
    public static function sendBadRequest(string $message)
    {
        $instance = new self(self::CODE_BAD_REQUEST, $message);
        $instance->send();
    }

    /**
     * Отправляет ошибку сервера
     * @param string $message
     */
    public static function sendFailure(string $message)
    {
        $instance = new self(self::CODE_FAILURE_SERVER, $message);
        $instance->send();
    }

    /**
     * Отправляет ответ
     */
    private function send()
    {
        $this->setHeaders();

        echo json_encode([
            'message' => $this->message,
            'status' => $this->code,
        ]);
    }

    /**
     * Устаналвивает заголовки
     */
    private function setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }
}