<?php

namespace Core\Import\FeedParser;

use Core\Import\FileParser\FileParserInterface;
use Core\Logger\TableLogger;
use Exception;


class ManufacturerFeedParser implements FeedParserInterface
{
	private FileParserInterface $fileParser;

	private TableLogger $logger;

	private array $errors;

	const IBLOCK_CODE_CATALOG_NEW = 'bitrix.catalog';

	public function __construct(TableLogger $logger)
	{
		$this->logger = $logger;
	}

	public function parseFeedToTable(array $arFeed): void
	{
		$labelName = "import_{$arFeed['UF_USER_ID']}";
		Debug::startTimeLabel($labelName);

		if (empty($arFeed['file_path'])) {
			$this->errors['Critical'][] = ['msg' => 'Не найдены файлы фида'];
			$this->logger->addToLog('parse feed', 'error', ['msg' => 'Пустой массив путей к файлам фида', 'feed_id' => $this->feedId]);
			throw new Exception('Пустой массив путей к файлам фида');
		}

		try {
			if (isset($this->fileParser)) {
				$this->fileParser->run($arFeed['UF_USER_ID'],$arFeed['ID'], $arFeed['file_path']);
			} else {
				throw new Exception('Не задан класс парсера файла');
			}
		} catch (\Exception $e) {
			$this->logger->addToLog('parse feed', 'error', ['msg' => $e->getMessage(), 'feed_id' => $this->feedId]);
			$this->errors['Critical'][] = ['msg' => $e->getMessage()];
		}

		$parseErrors = $this->fileParser->getErrors();
		if (!empty($parseErrors)) {
			$this->errors = array_merge($this->errors, $parseErrors);
		}

		Debug::endTimeLabel($labelName);
		$arLabels = Debug::getTimeLabels();
		$timeSpent = round($arLabels[$labelName]['time'], 2);
		$this->logger->addToLog('parse feed', 'success', ['msg' => "Время обработки файла: $timeSpent сек", 'feed_id' => $this->feedId]);
	}

	public function getFileParser(): FileParserInterface
	{
		return $this->fileParser;
	}

	public function setFileParser(FileParserInterface $fileParser): void
	{
		$this->fileParser = $fileParser;
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}
