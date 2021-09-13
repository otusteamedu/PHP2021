<?php

declare(strict_types=1);

namespace App\Responses;


use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ReportTaskResponse
 * @package mysite\app\DataTransfers
 */
class ReportTaskGetResponse implements Arrayable
{

    /**
     * ReportTaskGetResponse constructor.
     * @param int $id
     * @param string $status
     * @param Carbon $created_at
     */
    public function __construct(
        private int $id,
        private string $status,
        private Carbon $created_at
    ) {
    }


    /**
     * @return array
     */
    #[ArrayShape(['id' => "int", 'status' => "string", 'created_at' => "string"])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at->format("H:i d.m.Y"),
        ];
    }
}
