<?php

namespace App\Orchid\Layouts\Filial;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class FilialCreateOrUpdate extends Rows
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
            Input::make('filial.id')->type('hidden'),
            Input::make('filial.name')->title('Название')->required(),
            Input::make('filial.address')->title('Адрес'),
            Input::make('filial.phone')->title('Телефон')->mask('(999) 999-99-99'),
            Input::make('filial.email')->type('email')->title('Email'),
            TextArea::make('filial.description')->title('Коментарий')
        ];
    }
}
