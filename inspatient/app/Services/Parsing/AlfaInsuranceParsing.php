<?php

namespace App\Services\Parsing;

use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AlfaInsuranceParsing implements ParsingInterface
{
    private TitleCode $titleCode;

    public function __construct()
    {
        $this->titleCode = new TitleCode();
    }


    public function parse(Spreadsheet $spreadsheet, int $insuranceId): bool
    {
        $worksheet = $spreadsheet->getActiveSheet();
        //Найдем максимальные координаты
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn); // e.g. 5
        //Найдем строку - заголовок списка
        $titleCoordinate = [];
        $paramsRow = [];
        $titleRow = [];
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = mb_strtolower($worksheet->getCellByColumnAndRow($col, $row)->getValue(), "UTF-8");
                if (isset($value) && ($value != '')) {
                    $code = $this->titleCode->getTitleCode($value);
                    if (isset($code)) {
                        if ($code->part == 'title') {
                            $titleCoordinate[$code->key] = $col;
                            $titleRow[] = $row;
                        }
                    } else {
                        //  Проверим может быть это значимые данные
                        $paramsRow[$row] = $this->getArrayParams($value);
                    }
                }
            }
        }

//todo::Проверка основных полей

        if (isset($titleCoordinate['polisNumber']) && count($titleCoordinate) > 3) {
            $polis = [];
            $currentParams = [];
            for ($row = 1; $row <= $highestRow; ++$row) {
                if (!in_array($row, $titleRow)) {
                    if (isset($paramsRow[$row]) && count($paramsRow[$row]) > 0) {
                        //дополним параметрами из предыдущих строк
                        $currentParams = $paramsRow[$row];
                    }

                    $polisNumber = $worksheet->getCellByColumnAndRow($titleCoordinate['polisNumber'], $row)->getValue();
                    if (isset($polisNumber)) {
                        foreach ($titleCoordinate as $key => $val) {
                            $polis[$key] = $worksheet->getCellByColumnAndRow($val, $row)->getValue();
                        }
                        $polis = array_merge($polis, $currentParams);

                        $patientPolis = new PatientPolis;
                        $patientPolis->addPatientPolis($polis, $insuranceId);
                    }
                }
            }
        } else {
            Log::error('Не найдены колонки с данными');
            return false;
        }

        return true;
    }


    private function getArrayParams($value): array

    {
//        Разбираем массив параметров на составные части:
//        программа по факту: стоматология
//        срок страхования: с 15.12.2021 по 31.07.2022
//        страхователь: ооо бфт

        $result = [];
        $values = explode("\n", $value);
        foreach ($values as $val) {
            $params = explode(':', $val);
            if (count($params) > 1) {
                $titleCode = $this->titleCode->getTitleCode(trim($params[0]));
                if (isset($titleCode)) {
                    if ($titleCode->key == 'datePeriod') {
                        $dates = explode(' ', trim($params[1]));
                        $result['polisStartDate'] = $dates[1];
                        $result['polisEndDate'] = $dates[3];
                    } else {
                        $result[$titleCode->key] = trim($params[1]);
                    }
                }
            }
        }

        return $result;
    }

}