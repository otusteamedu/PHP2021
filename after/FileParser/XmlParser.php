<?php

namespace Core\Import\FileParser;

use Core\Import\Service\FeedsImportTempTable;

class XmlParser implements FileParserInterface
{

	private array $errors = [];

	public function run(int $userId, int $feedId, string $filePath): void
	{
		/**
		* Некоторая логика по обработке Xml файла фида находящегося по пути $filePath,
		* в рамках которой формируем массив $arFeedData для добавления во временную таблицу фидов
		* конкретному (пользователю) производителю $userId
		*/
		FeedsImportTempTable::addFeedData($arFeedData, $feedId);
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}
