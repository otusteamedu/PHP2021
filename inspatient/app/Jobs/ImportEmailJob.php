<?php

namespace App\Jobs;

use App\Models\Insurance;
use App\Models\PolisImport;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\File;
use Webklex\IMAP\Facades\Client;

class ImportEmailJob implements ImportEmailJobInterface
{
    private ImportPolisJobInterface $job;

    public function __construct(ImportPolisJobInterface $job)
    {
        $this->job = $job;
    }

    public function handle()
    {

        $client = Client::account('default');

        $client->connect();

        $folders = $client->getFolders();

        foreach ($folders as $folder) {

            $messages = $folder->messages()->markAsRead()->UNSEEN()->get();

            foreach ($messages as $message) {
                Log::info('Получино новое письмо от ' . $message->getFrom()[0]->mail . ' тема письма:' . $message->getSubject() .
                    ' Вложений : ' . $message->getAttachments()->count());

                //Если в письме есть вложения, начинаем обработку
                if ($message->getAttachments()->count() > 0) {

                    // определим от кого письмо
                    $insurance = Insurance::firstWhere('email', $message->getFrom()[0]->mail);
                    if (isset($insurance)) {
                        $insuranceId = $insurance->id;
                        Log::info('Страховая компания определена ' . $insurance->name);
                        foreach ($message->attachments as $attach) {
                            if ($attach->content_type == 'application/vnd.ms-excel'
                                or $attach->content_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                                Storage::disk('temp')->put($attach->getName(), $attach->getContent());
                                $uploadedFile = new UploadedFile(Storage::disk('temp')->path($attach->getName()), $attach->getName());
                                $file = new File($uploadedFile, 'polis_import', 'documents');
                                $attachment = $file->load();
                                $attachment->description = 'Импортировано из письма от ' .
                                    $message->getFrom()[0]->mail . '. Тема: ' . $message->getSubject() .
                                    ' Содержание письма: ' . $message->getTextBody();
                                $attachment->save();
                                Storage::disk('temp')->delete($attach->getName());
                                $polisImport = PolisImport::create(
                                    ['insurance_id' => $insuranceId,
                                        'attach_id' => $attachment->id,
                                        'processing_date' => now(),
                                        'processing_status_code' => 'importFromEmail']
                                );

                                $this->job->setId($polisImport->id);
                                try {
                                    app(Dispatcher::class)->dispatch($this->job);
                                } catch (\Exception $e) {
                                    $polisImport->update(['processing_status_code' => 'error',
                                        'processing_date' => now()]);
                                    return 'Ошибка ' . $e->getMessage();
                                }
                            }
                        }
                    } else {
                        Log::error('Не удалось определить страховую компанию по email ' . $message->getFrom()[0]->mail);
                    }
                }
            }
        }

    }
}