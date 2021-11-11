<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:19
 */

namespace app\components;

use InvalidArgumentException;

/**
 * Сервис валидации строки скобок
 *
 * Class BracketStringValidate
 * @package app
 */
class BracketStringValidate
{
    /**
     * @var array
     */
    private array $data;

    /**
     * BracketStringValidate constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     *
     */
    public function execute()
    {
        $this->validate();
    }

    /**
     * Валидация параметров
     */
    private function validate()
    {
        $data = $this->data;

        if (array_key_exists('string', $data) === false) {
            throw new InvalidArgumentException('Параметр String не найден');
        }

        if (empty($data['string']) === true) {
            throw new InvalidArgumentException('Параметр String пустой');
        }

        $this->validateString();
    }

    /**
     * Валидация параметра String
     */
    private function validateString()
    {
        $data = $this->data;
        $value = $data['string'];

        while (true) {
            $value = str_replace("()", "", $value, $count);
            if ($count === 0) {
                break;
            }
        }

        if (empty($value) === false) {
            throw new InvalidArgumentException('Содеримое параметра String не корректно');
        }
    }
}