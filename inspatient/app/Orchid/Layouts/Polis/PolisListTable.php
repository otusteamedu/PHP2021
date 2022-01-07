<?php

namespace App\Orchid\Layouts\Polis;

use App\Models\PolisView;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PolisListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'polis';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('patient_name', 'ФИО пациента')->filter(TD::FILTER_TEXT),
            TD::make('birthday', 'Д.р. пациента')->filter(TD::FILTER_TEXT),
            TD::make('insurance_name', 'Страховая компания')->filter(TD::FILTER_TEXT),
            TD::make('number', 'Номер полиса')->filter(TD::FILTER_TEXT),
            TD::make('startDate', 'Дата начала действия'),
            TD::make('endDate', 'Дата окончания действия'),
            TD::make('avans', 'Тип обслуживания')->render(function ($polis) {
                return $polis->avans === 1 ? 'Аванс' : 'Факт';
            }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (PolisView $polis) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.polis.edit', $polis->id)
                                ->icon('pencil'),

//                            Button::make('Скрыть')
//                                ->icon('trash')
//                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
//                                ->method('remove', [
//                                    'id' => $polis->id,
//                                ]),
                        ]);
                }),
        ];
    }
}
