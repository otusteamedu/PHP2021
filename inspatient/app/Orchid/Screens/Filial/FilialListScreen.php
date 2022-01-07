<?php

namespace App\Orchid\Screens\Filial;

use App\Http\Requests\FilialRequest;
use App\Models\Filial;
use App\Orchid\Layouts\Filial\FilialCreateOrUpdate;
use App\Orchid\Layouts\Filial\FilialListTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FilialListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Филиалы';
    public $description = 'Список филиалов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ['filial' => Filial::filters()->paginate(15)];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Добавить филиал')
                ->modal('createFilial')
                ->icon('plus')
                ->method('createOrUpdateFilial'),

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
            FilialListTable::class,

            Layout::modal('createFilial', FilialCreateOrUpdate::class)
                ->title('Добавить филиал')
                ->applyButton('Создать'),

            Layout::modal('editFilial', FilialCreateOrUpdate::class)
                ->async('asyncGetFilial')
                ->title('Изменить филиал')
                ->applyButton('Сохранить')
        ];
    }

    public function asyncGetFilial(Filial $filial): array
    {
        return [
            'filial' => $filial
        ];
    }


    public function createOrUpdateFilial(FilialRequest $request)
    {
        $filialId = $request->input('filial.id');
        Filial::updateOrCreate([
            'id' => $filialId
        ], $request->validated()['filial']);

        is_null($filialId) ? Toast::info('Новый филиал добавлен') : Toast::info('Запись обновлена');
    }


}
