<?php

namespace App\Orchid\Layouts\Program;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class ProgramCreateOrUpdate extends Rows
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
            Input::make('program.id')->type('hidden'),
            Input::make('program.name')->title('Название')->required(),
            TextArea::make('program.description')->title('Коментарий')
        ];
    }
}
