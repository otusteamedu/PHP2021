<?php

declare(strict_types=1);

namespace App\Responses;

use Illuminate\Contracts\Support\Arrayable;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ReportTaskPostResponse
 * @package mysite\app\Responses
 */
class ReportTaskPostResponse implements Arrayable
{

    /**
     * ReportTaskPostResponse constructor.
     * @param int $id
     */
    public function __construct(
        private int $id
    ) {
    }


    /**
     * @return array
     */
    #[ArrayShape(['success' => "bool", 'task_id' => "int|null", 'link' => "string"])]
    public function toArray(): array
    {
        return [
            'success' => (bool)$this->id,
            'task_id' => $this->id,
            'link' => route(
                'report_task',
                [
                    'reportTaskId' => $this->id
                ]
            )
        ];
    }
}
