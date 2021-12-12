<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 18:52
 */

namespace app\indices;

/**
 * Interface BaseIndex
 * @package app\indices
 */
interface BaseIndex
{
    /**
     * Название индекса
     * @return string
     */
    public static function index(): string;

    /**
     * Параметры для индексирования
     * @return array
     */
    public function toParams(): array;
}