<?php

namespace App;

class Response
{
    public static function generateResponse($errorCode)
    {
        switch ($errorCode) {

            case 'BRACKETS_PAIR_OK':
                header('HTTP/1.0 200 Ok');

                break;

            default:
                header('HTTP/1.0 400 Bad Request');
        }

        echo self::getErrorMessage($errorCode) . PHP_EOL;
    }

    private static function getErrorMessage($errorCode)
    {
        switch ($errorCode) {

            case 'ERROR_REQUEST_METHOD':
                return 'Ошибочный метод запроса :(';

                break;

            case 'EMPTY_REQUEST':
                return 'Пустой запрос :/';

                break;

            case 'EMPTY_INPUT':
                return 'Ничего не введено :|';

                break;

            case 'BRACKETS_MISSING':
                return 'В введённом тексте отсутсвуют скобки :0';

                break;

            case 'WITHOUT_PAIR_BRACKETS':
                return 'У одной из скобок отсусвует пара :(';

                break;

            case 'BRACKETS_PAIR_OK':
                return 'Со скобками всё хорошо :)';

                break;

            default:
                return 'Неизвестная ошибка :(';
        }
    }
}
