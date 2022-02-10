<?php

namespace App\Orchid\Screens\Program;

use App\Http\Requests\ProgramRequest;
use App\Models\Program;
use App\Orchid\Layouts\Filial\FilialCreateOrUpdate;
use App\Orchid\Layouts\Program\ProgramCreateOrUpdate;
use App\Orchid\Layouts\Program\ProgramListTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProgramListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Страховые программы';
    public $description = 'Список страховых програм';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ['program' => Program::filters()->paginate(15)];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Добавить программу')
                ->modal('createProgram')
                ->icon('plus')
                ->method('createOrUpdateProgram')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [ProgramListTable::class,

            Layout::modal('createProgram', ProgramCreateOrUpdate::class)
                ->title('Добавить страховую программу')
                ->applyButton('Создать'),

            Layout::modal('editProgram', ProgramCreateOrUpdate::class)
                ->async('asyncGetProgram')
                ->title('Изменить страховую программу')
                ->applyButton('Сохранить')
        ];
    }

    public function asyncGetProgram(Program $program): array
    {
        return [
            'program' => $program
        ];
    }


    public function createOrUpdateProgram(ProgramRequest $request)
    {
        $programId = $request->input('program.id');
        Program::updateOrCreate([
            'id' => $programId
        ], $request->validated()['program']);

        is_null($programId) ? Toast::info('Новый филиал добавлен') : Toast::info('Запись обновлена');
    }
}
