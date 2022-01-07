<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\Filial;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class PatientEditLayout extends Rows
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
            Input::make('patient.id')
                ->type('hidden'),

            Input::make('patient.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title('ФИО пациента')
                ->placeholder('ФИО пациента'),

            Input::make('patient.birthday')
                ->type('date')
                ->required()
                ->title('Дата рождения')
                ->placeholder('Дата рождения пациента'),
            Group::make([
                Input::make('patient.phone')
                    ->type('phone')
                    ->mask('(999) 999-99-99')
                    ->title('Номер телефона')
                    ->placeholder('Номер телефона'),

                Input::make('patient.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->placeholder(__('Email'))
            ]),

            TextArea::make('patient.address')
                ->title('Адрес проживания')
                ->placeholder('Адрес проживания'),

            Input::make('patient.work')
                ->type('text')
                ->max(100)
                ->title('Место работы')
                ->placeholder('Место работы'),

            Relation::make('patient.filial_id')
                ->title('Филиан прикрепления')
                ->fromModel(Filial::class, 'name'),

            Input::make('aboutAdding')
                ->title('Информация о добавлении в базу'),

            Input::make('aboutRemove')
                ->title('Информация о снятии с обслуживания'),

            TextArea::make('patient.description')
                ->title('Коментарий')
                ->placeholder('Коментарий')

        ];
    }
}
