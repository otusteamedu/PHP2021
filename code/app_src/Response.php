<?php

namespace App;

class Response
{
    private static array $arErrors = [
        'ERROR_REQUEST_METHOD' => 'Ошибочный метод запроса :(',
        'EMPTY_REQUEST' => 'Пустой запрос :/',
        'EMPTY_INPUT' => 'В поле ничего не введено :|',
        'DATA_NO_GENERATED' => 'Данные не сгенерированы o_0',
        'EMAIL_OK' => 'Адрес валиден и MX-запись найдена :)',
        'EMAIL_MX_FAILED' => 'MX запись для адреса, не найдено :(',
        'EMAIL_VALID_FAILED' => 'Адрес не прошёл валидацию :('
    ];

    public static function generateOkResponse(string $code)
    {
        header('HTTP/1.0 200 Ok');

        return self::getErrorMessage($code) . '<br>';
    }

    public static function generateBadRequestResponse(string $errorCode)
    {
        header('HTTP/1.0 400 Bad Request');

        return self::getErrorMessage($errorCode) . PHP_EOL;
    }

    private static function getErrorMessage(string $errorCode): string
    {
        return self::$arErrors[$errorCode];
    }
}
