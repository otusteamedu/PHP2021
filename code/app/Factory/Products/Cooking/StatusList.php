<?php

declare(strict_types=1);

namespace App\Factory\Products\Cooking;

final class StatusList
{
    public const STATUS_WAITING = "Ожидает готовки";
    public const STATUS_IN_PROGRESS = "Готовится";
    public const STATUS_FINISHED = "Закончили готовку";
    public const STATUS_DELIVERED = "Отдан в заказ";
}