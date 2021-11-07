<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:19
 */

namespace app;

use InvalidArgumentException;

/**
 * Сервис валидации строки
 *
 * Class StringValidateForm
 * @package app
 */
class StringValidateForm
{
    /**
     * @var array
     */
    private array $data;

    /**
     * StringValidateForm constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $this->validate();
        return $this->createResponse();
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

    /**
     * Создает ответ
     */
    private function createResponse(): array
    {
        return [
            'message' => 'OK',
        ];
    }
}