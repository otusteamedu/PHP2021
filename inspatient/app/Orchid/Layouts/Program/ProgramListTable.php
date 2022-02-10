<?php

namespace App\Orchid\Layouts\Program;

use App\Models\Program;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProgramListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'program';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Название страховой программы')->filter(TD::FILTER_TEXT),
            TD::make('description', 'Коментарий')->filter(TD::FILTER_TEXT),
            TD::make('action', 'Действия')->render(function (Program $program) {
                return ModalToggle::make('')
                    ->modal('editProgram')
                    ->icon('pencil')
                    ->method('createOrUpdateProgram')
                    ->asyncParameters(['program' => $program->id]);
            })
        ];
    }
}
