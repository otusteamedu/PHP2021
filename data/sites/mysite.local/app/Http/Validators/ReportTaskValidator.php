<?php

declare(strict_types=1);

namespace App\Http\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DataTransfers\ReportTaskTransfer;

/**
 * Class ReportTaskValidator
 * @package App\Http\Validators
 */
class ReportTaskValidator
{
    /**
     * @param Request $request
     * @return ReportTaskTransfer
     */
    public function validate(Request $request): ReportTaskTransfer
    {
        $validated = Validator::validate(
            $request->toArray(),
            [
                'report_type_id' => 'required|integer|exists:report_types,id',
                'destination' => 'required'
            ]
        );

        return ReportTaskTransfer::createFromArray($validated);
    }
}
