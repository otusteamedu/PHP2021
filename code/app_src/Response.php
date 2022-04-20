<?php

namespace App;

class Response
{
    public static function generateOkResponse(array $arResult)
    {
        header('HTTP/1.0 200 Ok');

        foreach ($arResult as $result) {
            echo self::getErrorMessage($result['RESULT'], $result['EMAIL']) . '<br>';
        }
    }

    public static function generateBadRequestResponse(string $errorCode)
    {
        header('HTTP/1.0 400 Bad Request');

        echo self::getErrorMessage($errorCode) . PHP_EOL;
    }

    private static function getErrorMessage(string $errorCode, string $email = null): string
    {
        switch ($errorCode) {

            case 'ERROR_REQUEST_METHOD':
                return 'Ошибочный метод запроса :(';

                break;

            case 'EMPTY_REQUEST':
                return 'Пустой запрос :/';

                break;

            case 'EMPTY_INPUT':
                return 'В поле ничего не введено :|';

                break;

            case 'DATA_NO_GENERATED':
                return 'Данные не сгенерированы o_0';

                break;

            case 'EMAIL_OK':
                return "Адрес $email валиден и MX-запись найдена :)";

                break;

            case 'EMAIL_MX_FAILED':
                return "MX запись для адреса $email, не найдено :(";

                break;

            case 'EMAIL_VALID_FAILED':
                return "Адрес $email не прошёл валидацию :(";

                break;

            default:
                return 'Неизвестная ошибка 0_0';
        }
    }
}
