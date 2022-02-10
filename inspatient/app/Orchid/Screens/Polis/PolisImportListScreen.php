<?php

namespace App\Orchid\Screens\Polis;

use App\Http\Requests\PolisImportRequest;
use App\Jobs\ImportPolisJobInterface;
use App\Models\PolisImport;
use App\Orchid\Layouts\Polis\PolisImportLayout;
use App\Orchid\Layouts\Polis\PolisImportTable;
use Illuminate\Contracts\Bus\Dispatcher;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;


class PolisImportListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Импорт полисов';
    public $description = 'Список файлов импорта полисов';

    private ImportPolisJobInterface $job;

    public function __construct(ImportPolisJobInterface $job)
    {
        $this->job = $job;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return ['polisImport' => PolisImport::paginate(15)];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Загрузить из файла')
                ->modal('polisImport')
                ->icon('new-doc')
                ->method('createOrUpdatePolisImport'),
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
            PolisImportTable::class,

            Layout::modal('polisImport', PolisImportLayout::class)
                ->title('Импорт полисов из файла')
                ->applyButton('Импортировать'),

            Layout::modal('editPolisImport', PolisImportLayout::class)
                ->async('asyncGetPolisImport')
                ->title('Редактировать импорт полисов из файла')
                ->applyButton('Сохранить')
        ];
    }

    public function asyncGetPolisImport(PolisImport $polisImport): array
    {
        $this->test();

        $polisImport->load('attach');

        return [
            'polisImport' => $polisImport
        ];
    }

    public function createOrUpdatePolisImport(PolisImportRequest $request)
    {


        $polisImportId = $request->input('polisImport.id');

        $polisImport = PolisImport::updateOrCreate([
            'id' => $polisImportId
        ], array_merge(
            $request->validated()['polisImport'],
            [
                'attach_id' => array_shift($request->validated()['polisImport']['attach_id'])
            ]
        ));

        if ($polisImportId != $polisImport->id) {
            $this->job->setId($polisImport->id);
            $polisImport->update(['processing_status_code' => 'open',
                'processing_date' => now()]);
            try {
                app(Dispatcher::class)->dispatch($this->job);
            } catch (\Exception $e) {
                $polisImport->update(['processing_status_code' => 'error',
                    'processing_date' => now()]);
                return 'Ошибка ' . $e->getMessage();
            }
        }

        is_null($polisImportId) ? Toast::info('Новый файл добавлен') : Toast::info('Запись обновлена');
    }


    public function test()
    {
    }
}
