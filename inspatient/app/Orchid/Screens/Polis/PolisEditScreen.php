<?php

namespace App\Orchid\Screens\Polis;

use App\Http\Requests\PolisImportRequest;
use App\Models\Polis;
use App\Orchid\Layouts\Polis\PolisEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PolisEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактирование страхового полиса';


    /**
     * @var Polis
     */
    private $polis;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Polis $polis): array
    {
        $this->polis = $polis;

        if (!$polis->exists) {
            $this->name = 'Создание нового страхового полиса';
        }

        return [
            'polis' => $polis
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->polis->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('createOrUpdatePolis'),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [PolisEditLayout::class];
    }

    public function createOrUpdatePolis(PolisImportRequest $request)
    {
        $polisId = $request->input('polis.id');
        Polis::updateOrCreate([
            'id' => $polisId
        ], $request->validated()['polis']);

        is_null($polisId) ? Toast::info('Новый полис добавлен') : Toast::info('Запись обновлена');
        return redirect()->route('platform.polis');
    }

}
