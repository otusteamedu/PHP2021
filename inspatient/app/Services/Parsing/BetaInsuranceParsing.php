<?php

namespace App\Services\Parsing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class BetaInsuranceParsing implements ParsingInterface
{

    public function parse(Spreadsheet $spreadsheet, int $insuranceId): bool
    {
        return true;
    }
}