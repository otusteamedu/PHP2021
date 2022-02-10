<?php

namespace App\Orchid\Layouts\Insurance;

use App\Models\Insurance;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class InsuranceListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'insurance';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Название страховой')->filter(TD::FILTER_TEXT),
            TD::make('address', 'Адрес страховой')->filter(TD::FILTER_TEXT),
            TD::make('phone', 'Номер телефона')->filter(TD::FILTER_TEXT),
            TD::make('email', 'email'),
            TD::make('action', 'Действия')->render(function (Insurance $insurance) {
                return ModalToggle::make('')
                    ->modal('editInsurance')
                    ->icon('pencil')
                    ->method('createOrUpdateInsurance')
                    ->asyncParameters(['insurance'=> $insurance->id]);
            })
            ];
    }
}
