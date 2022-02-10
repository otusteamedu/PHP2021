<?php

namespace App\Services\Parsing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface ParsingInterface
{
    public function parse(Spreadsheet $spreadsheet, int $insuranceId): bool;
}