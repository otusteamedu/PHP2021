<?php

namespace App\Services\Parsing;

use App\Models\Patient;
use App\Models\Polis;
use App\Models\Program;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PatientPolis
{
    public function addPatientPolis(array $polis, int $insuranceId)
    {
        $polis['patientName'] = $this->normalizeName(
            $polis['patientName'] ?? null,
            $polis['patientLastName'] ?? null,
            $polis['patientFirstName'] ?? null,
            $polis['patientPatronymic'] ?? null,
        );


        //Преобразуем даты
        $polis['patientBirthday'] = $this->formatDate($polis['patientBirthday']);
        $polis['polisStartDate'] = isset($polis['polisStartDate']) ? $this->formatDate($polis['polisStartDate']) : now();
        $polis['polisEndDate'] = isset($polis['polisEndDate']) ? $this->formatDate($polis['polisEndDate']) : now();

        //добавим пациента
        $patient = Patient::updateOrCreate(['name' => $polis['patientName'], 'birthday' => $polis['patientBirthday']],
            [
                'name' => $polis['patientName'],
                'birthday' => $polis['patientBirthday'],
                'phone' => $polis['patientPhone'] ?? null,
                'email' => $polis['patientEmail'] ?? null,
                'address' => $polis['patientAddress'] ?? null,
                'work' => $polis['patientWork'] ?? null,
                'aboutAdding' => $polis['aboutAdding'] ?? null,
                'aboutRemove' => $polis['aboutRemove'] ?? null
            ]);

        //добавим программу обслуживания
        if (array_key_exists('polisProgram', $polis)) {
            $program = Program::updateOrCreate(['name' => $polis['polisProgram']], ['name' => $polis['polisProgram']]);
        }

        //добавим полис
        $polis = Polis::updateOrCreate(
            [
                'number' => $polis['polisNumber'],
                'patient_id' => $patient->id,
                'insurance_id' => $insuranceId,
            ],
            [
                'number' => $polis['polisNumber'],
                'patient_id' => $patient->id,
                'insurance_id' => $insuranceId,
                'startDate' => $polis['polisStartDate'],
                'endDate' => $polis['polisEndDate'],
                'avans' => $polis['polisAvans'] ?? false,
                'program_id' => $program->id ?? null
            ]
        );
    }

    private function formatDate($date)
    {
        if (is_numeric($date)) {
            $result = Date::excelToDateTimeObject($date);
        } else {
            $result = date_create_from_format('d.m.Y', $date);
        }

        return $result;
    }

    private function normalizeName($patientName, $patientLastName, $patientFirstName, $patientPatronymic): string
    {
        if ($patientName == null) {
            $patientName = $patientLastName . ' ' . $patientFirstName . ' ' . $patientPatronymic;
        }

        return mb_convert_case(mb_strtolower($patientName, "UTF-8"), MB_CASE_TITLE);
    }
}