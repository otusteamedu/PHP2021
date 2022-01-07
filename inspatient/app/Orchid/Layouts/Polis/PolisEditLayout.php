<?php

namespace App\Orchid\Layouts\Polis;

use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Program;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class PolisEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('polis.id')
                ->type('hidden'),

            Relation::make('polis.patient_id')
                ->title('Пациент')
                ->required()
                ->fromModel(Patient::class, 'name')
                ->displayAppend('full')
                ->searchColumns('birthday'),

            Relation::make('polis.insurance_id')
                ->title('Страховая компания')
                ->required()
                ->fromModel(Insurance::class, 'name'),

            Input::make('polis.number')
                ->type('text')
                ->required()
                ->title('Номер полиса')
                ->placeholder('Номер полиса'),
            Group::make([
                Input::make('polis.startDate')
                    ->type('date')
                    ->title('Срок действия с')
                    ->placeholder('Дата начала действия полиса'),

                Input::make('polis.endDate')
                    ->type('date')
                    ->title('по')
                    ->placeholder('Дата оканчания действия полиса'),
            ])->autoWidth(),
            CheckBox::make('polis.avans')
                ->title('Тип обслуживания ')
                ->placeholder('Аванс')
                ->sendTrueOrFalse(),

            Relation::make('polis.program_id')
                ->title('Страховая программа')
                ->fromModel(Program::class, 'name'),

            TextArea::make('polis.description')
                ->title('Коментарий')
                ->placeholder('Коментарий')

        ];
    }
}
