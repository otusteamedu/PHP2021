<?php

namespace App\Jobs;

use App\Models\PolisImport;
use App\Services\Parsing\ParsingInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ImportPolisJob implements ShouldQueue, ImportPolisJobInterface
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $id;
    private ParsingInterface $parsing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ParsingInterface $parsing)
    {
        $this->parsing = $parsing;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Старт работы ' . $this->id);
        $polisImport = PolisImport::find($this->id);
        $polisImport->update(['processing_status_code' => 'working', 'processing_date' => now()]);

        Log::info('Загружаем вложение ' . $polisImport->attach_id);

        $attach = Attachment::find($polisImport->attach_id);
        $inputFileName = Storage::disk('polis_import')->path($attach->physicalPath());

        try {
            $reader = IOFactory::createReaderForFile($inputFileName);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($inputFileName);
            Log::info('Файл загружен ' . $inputFileName);
        } catch (Exception $e) {
            Log::error('Ошибка при загрузке файла ' . $inputFileName . ' ' . $e->getMessage());
            $polisImport->update(['processing_status_code' => 'error', 'processing_date' => now()]);
        } finally {
            //определяем клас обработки страховой
            //todo:: в будущем определяем класс обработки страховой, пока все уместилось в AlfaInsuranceParsing

            //запускаем парсинг
            $parsing = $this->parsing->parse($spreadsheet, $polisImport->insurance_id);

            if ($parsing) {
                Log::info('Данные импортированы');
                $polisImport->update(['processing_status_code' => 'done', 'processing_date' => now()]);
            }
            else
            {
                Log::error('Ошибка при импорте данных');
                $polisImport->update(['processing_status_code' => 'error', 'processing_date' => now()]);
            }
        }

    }


}
