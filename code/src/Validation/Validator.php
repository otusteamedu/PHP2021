<?php

namespace App\Validation;

use App\Http\Response;

class Validator
{
    const OPEN_BRACKET = '(';
    const CLOSE_BRACKET = ')';
    private static ?array $strArr = null;

    /**
     * @param string $string
     * @throws \Exception
     */
    public static function validate(string $string) : void
    {
        if (self::checkBrackets($string)) {
            throw new \Exception("", Response::STATUS_OK);
        } else {
            throw new \Exception('', Response::STATUS_BAD_REQUEST);
        }
    }

    /**
     * @param string $string
     * @return bool
     * Проверка на:
     *  - Корректность кол-ва открытых и закрытых скобок
     *  - Соответствие скобок должно быть и с точки зрения скобок. Тест ")(" не должен проходить
     */
    private static function checkBrackets(string $string) : bool
    {
        if ((strlen($string) % 2) !== 0) {
            return false;
        }

        self::$strArr = str_split($string);
        if (!empty(self::$strArr)) {
            self::removePairBracketsRecursive();
            if (empty(self::$strArr)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Рекурсивно удаляет парные скобки
     */
    private static function removePairBracketsRecursive() : void
    {
        $isChanged = false;
        $openKey = null;
        foreach (self::$strArr as $key => $item) {

            if (isset($openKey) && $item === self::CLOSE_BRACKET) {
                unset(self::$strArr[$openKey]);
                unset(self::$strArr[$key]);
                $isChanged = true;
                $openKey = null;
                continue;
            }

            if ($item === self::OPEN_BRACKET) {
                $openKey = $key;
            } else {
                $openKey = null;
            }
        }

        // Если на прошедшой итерации были удалены парные скобки ($isChanged), и массив со скобками
        // все еще не пуст - запускаем новую итерацию на удаление скобок. Иначе, считаем что все
        // парные скобки удалены, поэтому выходим из рекурсии
        if ($isChanged && !empty(self::$strArr)) {
            self::removePairBracketsRecursive();
        }
    }
}
