<?php

namespace Core\Import\FileParser;

use Core\Import\Service\FeedsImportTempTable;

class ExcelParser implements FileParserInterface
{
	
	private array $errors = [];

	public function run(): void
	{
		/**
		* Некоторая логика по обработке Excel файла фида,
		* в рамках которой формируем массив $arFeedData для добавления во временную таблицу фидов
		*/
		FeedsImportTempTable::addFeedData($arFeedData);		
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}
