<?php

namespace App\Orchid\Layouts\Polis;

use App\Models\PolisImport;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PolisImportTable extends Table
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $target = 'polisImport';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('insurance_name', 'Страховая компания')->render(
                function (PolisImport $polisImport) {
                    return $polisImport->insurance->name;
                }
            ),

            TD::make('attach_name', 'Имя файла')->render(
                function (PolisImport $polisImport) {
                    return $polisImport->attach->original_name;
                }
            ),
            TD::make('processing_state', 'Статус обработки')->render(
                function (PolisImport $polisImport) {

                    return isset($polisImport->processingStatus)?$polisImport->processingStatus->status : 'не определен';
                }
            ),
            TD::make('processing_date', 'Дата обработки'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (PolisImport $polisImport) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            ModalToggle::make('Открыть')
                                ->modal('editPolisImport')
                                ->icon('pencil')
                                ->method('createOrUpdatePolisImport')
                                ->asyncParameters(['polisImport' => $polisImport->id]),


//                            Button::make('Скрыть')
//                                ->icon('trash')
//                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
//                                ->method('remove', [
//                                    'id' => $polisImport->id,
//                                ]),
                        ]);
                }),

        ];
    }
}
