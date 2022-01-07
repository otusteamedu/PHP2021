<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\Patient;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'patients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'ФИО пациента')->filter(TD::FILTER_TEXT),
            TD::make('birthday', 'Дата рождения')->filter(TD::FILTER_DATE),
            TD::make('phone', 'Номер телефона')->filter(TD::FILTER_TEXT),
            TD::make('email', 'email'),
            TD::make('action', 'Редактировать')->render(function (Patient $patient) {
                return ModalToggle::make('')
                    ->modal('editPatient')
                    ->icon('pencil')
                    ->method('createOrUpdatePatient')
                    ->asyncParameters(['Patient'=> $patient->id]);
            })
        ];
    }
}
