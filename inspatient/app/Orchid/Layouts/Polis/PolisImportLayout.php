<?php

namespace App\Orchid\Layouts\Polis;

use App\Models\Insurance;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class PolisImportLayout extends Rows
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
            Input::make('polisImport.id')
                ->type('hidden'),

            Relation::make('polisImport.insurance_id')
                ->title('Страховая компания')
                ->required()
                ->fromModel(Insurance::class, 'name'),

            Upload::make('polisImport.attach_id')
                ->maxFiles(1)
                ->acceptedFiles('.xls, .xlsx')
                ->storage('polis_import')
                ->groups('documents')
                ->title('Файлы Excels')

        ];
    }
}
