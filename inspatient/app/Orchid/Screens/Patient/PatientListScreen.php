<?php

namespace App\Orchid\Screens\Patient;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Orchid\Layouts\Patient\PatientEditLayout;
use App\Orchid\Layouts\Patient\PatientListTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PatientListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Пациенты';
    public $description = 'Список пациентов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'patients' => Patient::filters()->paginate(15)
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
            ModalToggle::make('Добавить пациента')
                ->modal('createPatient')
                ->icon('plus')
                ->method('createOrUpdatePatient'),

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
            PatientListTable::class,
            Layout::modal('createPatient', PatientEditLayout::class)
                ->title('Добавить пациента')
                ->applyButton('Создать'),

            Layout::modal('editPatient', PatientEditLayout::class)
                ->async('asyncGetPatient')
                ->title('Редактировать пациента')
                ->applyButton('Сохранить')

        ];
    }


    public function asyncGetPatient(Patient $patient): array
    {
        return [
            'patient' => $patient
        ];
    }


    public function createOrUpdatePatient(PatientRequest $request)
    {
        $patientId = $request->input('patient.id');
        Patient::updateOrCreate([
            'id' => $patientId
        ], $request->validated()['patient']);

        is_null($patientId) ? Toast::info('Новый пациент добавлен') : Toast::info('Запись обновлена');
    }
}
