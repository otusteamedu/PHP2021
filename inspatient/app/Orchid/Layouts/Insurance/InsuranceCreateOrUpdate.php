<?php

namespace App\Orchid\Layouts\Insurance;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class InsuranceCreateOrUpdate extends Rows
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
            Input::make('insurance.id')->type('hidden'),
            Input::make('insurance.name')->title('Название')->required(),
            Input::make('insurance.address')->title('Адрес'),
            Input::make('insurance.phone')->title('Телефон')->mask('(999) 999-99-99'),
            Input::make('insurance.email')->type('email')->title('Email'),
            TextArea::make('insurance.description')->title('Коментарий')
        ];
    }
}
