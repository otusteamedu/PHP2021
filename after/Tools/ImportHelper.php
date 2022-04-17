<?php

use Core\Import\FileParser\FileParserInterface;
use Core\Import\FileParser\XmlParser;
use Core\Import\FileParser\ExcelParser;

class ImportHelper
{
	public static function getFileParserInterface(string $fileType): FileParserInterface
	{
		switch ($fileType) {
			case 'application/xml':
				return new XmlParser();

			case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
				return new ExcelParser();

			default:
				throw new Exception('Ошибка чтения файла: неверный тип файла');
		}

	}
	
	public static function getFeedInfo(int $feedId): array
	{
		$filePath = $_SERVER['DOCUMENT_ROOT'].\CFile::GetPath($fileId);
		$arFile = \CFile::MakeFileArray($filePath);
		
		if (!file_exists($arFile['tmp_name'])) {
			throw new Exception('Ошибка чтения файла: файл отсутствует');
		}
		
		return $arFile;
	}
}