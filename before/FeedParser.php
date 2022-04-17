<?php

namespace Core\Import;

use Core\Logger\TableLogger;
use Core\Logger\FeedsImporterDebugLogTable;

use Core\Import\Excel\ExcelParser;

class FeedParser
{
    private $feedFilePath;

    private $feedId;

    private $manufacturerId;

    private $logger;

    private $errors = [];

    private ExcelParser $excelParser;

    public function __construct()
    {
        $this->logger = new TableLogger(new FeedsImporterDebugLogTable());
        $this->tempFolder = "{$_SERVER['DOCUMENT_ROOT']}/upload/feeds_temp/";
        $this->excelParser = new ExcelParser();
    }

    /**
     * Считываем содержимое фида во временную таблицу
     * @param $arFeed
     * @return void
     * @throws \Bitrix\Main\ObjectException
     */
    public function parseFeedToTable($arFeed)
    {
        $labelName = "import_{$arFeed['UF_USER_ID']}";
        Debug::startTimeLabel($labelName);

        $this->feedId = $arFeed['ID'];
        $this->manufacturerId = $arFeed['UF_USER_ID'];
		$this->checkfeedFile($arFeed['UF_FILE']);

        if (empty($this->feedFilePath)) {
            $this->errors['Critical'][] = ['msg' => 'Не найдены файлы фида'];
            $this->logger->addToLog('parse feed', 'error', ['msg' => 'Пустой массив путей к файлам фида', 'feed_id' => $this->feedId]);
            return;
        }

        try {
            $this->excelParser->run($this->manufacturerId, $this->feedId, $this->feedFilePath);
        } catch (\Exception $e) {
            $this->logger->addToLog('parse feed', 'error', ['msg' => $e->getMessage(), 'feed_id' => $this->feedId]);
			$this->errors['Critical'][] = ['msg' => 'Критическая ошибка в работе модуля ExcelParser'];
        }

        $parseErrors = $this->excelParser->getErrors();
        if (!empty($parseErrors)) {
            $this->errors = array_merge($this->errors, $parseErrors);
        }

        Debug::endTimeLabel($labelName);
        $arLabels = Debug::getTimeLabels();
        $timeSpent = round($arLabels[$labelName]['time'], 2);
        $this->logger->addToLog('parse feed', 'success', ['msg' => "Время обработки файла: $timeSpent сек", 'feed_id' => $this->feedId]);
    }

    /**
     * Проверка файла фида на валидность
     */
    private function checkfeedFile(int $fileId): bool
    {

        if ($fileId <= 0) {
            $this->errors['Critical'][] = ['msg' => 'Получен некорректный ID файла'];
            $this->logger->addToLog('parser set files paths', 'error', ['msg' => 'Некорректный ID файла', 'feed_id' => $this->feedId]);
            return false;
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . \CFile::GetPath($fileId);
        $arFile = \CFile::MakeFileArray($filePath);

		if ($arFile['type'] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
			$this->errors['Critical'][] = ['msg' => 'Предоставлен неверный тип файла'];
			$this->logger->addToLog('parser set files paths', 'error', ['msg' => 'Неверный тип', 'feed_id' => $this->feedId, 'file_id' => $fileId]);
			return false;
		}
		
        if (!file_exists($arFile['tmp_name'])) {
            $this->errors['Critical'][] = ['msg' => 'Получен путь до несуществующего файла'];
            return false;
        }

		$this->feedFilePath = $filePath;
		return $arFile;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
