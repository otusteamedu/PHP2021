<?php

namespace App\Orchid\Layouts\Filial;

use App\Models\Filial;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FilialListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'filial';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Название филиала')->filter(TD::FILTER_TEXT),
            TD::make('address', 'Адрес филиала')->filter(TD::FILTER_TEXT),
            TD::make('phone', 'Номер телефона')->filter(TD::FILTER_TEXT),
            TD::make('email', 'email'),
            TD::make('action', 'Действия')->render(function (Filial $filial) {
                return ModalToggle::make('')
                    ->modal('editFilial')
                    ->icon('pencil')
                    ->method('createOrUpdateFilial')
                    ->asyncParameters(['filial'=> $filial->id]);
            })
        ];
    }
}
