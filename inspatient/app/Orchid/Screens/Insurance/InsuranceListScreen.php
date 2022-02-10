<?php

namespace App\Orchid\Screens\Insurance;

use App\Http\Requests\FilialRequest;
use App\Models\Filial;
use App\Models\Insurance;
use App\Orchid\Layouts\Filial\FilialCreateOrUpdate;
use App\Orchid\Layouts\Insurance\InsuranceCreateOrUpdate;
use App\Orchid\Layouts\Insurance\InsuranceListTable;
use App\Http\Requests\InsuranceRequest;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class InsuranceListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Страховые компании';
    public $description = 'Список страховых компаний';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ['insurance' => Insurance::filters()->paginate(15)];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Добавить страховую')
                ->modal('createInsurance')
                ->icon('plus')
                ->method('createOrUpdateInsurance')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            InsuranceListTable::class,
            Layout::modal('createInsurance', InsuranceCreateOrUpdate::class)
                ->title('Добавить страховую')
                ->applyButton('Создать'),

            Layout::modal('editInsurance', InsuranceCreateOrUpdate::class)
                ->async('asyncGetInsurance')
                ->title('Изменить страховую')
                ->applyButton('Сохранить')
            ];
    }

    public function asyncGetInsurance(Insurance $insurance): array
    {
        return [
            'insurance' => $insurance
        ];
    }
    public function createOrUpdateInsurance(InsuranceRequest $request)
    {
        $insuranceId = $request->input('insurance.id');
        Insurance::updateOrCreate([
            'id' => $insuranceId
        ], $request->validated()['insurance']);

        is_null($insuranceId) ? Toast::info('Новая страховая компания добавлена') : Toast::info('Запись обновлена');
    }
}
