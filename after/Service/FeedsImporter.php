<?php

namespace Core\Import\Service;

use Core\Import\Logger\TableLogger;
use Core\Import\Tools\ImportHelper;
use Core\Import\FeedParser\FeedParserInterface;
use Core\Import\FileParser\FileParserInterface;
use Exception;
use Bitrix\Catalog\Model;
use CFile;

class FeedsImporter
{
	private int $feedId;
	
	private TableLogger $logger;
	
	private ImportHelper $importHelper;
	
	private FeedParserInterface $feedParser;
	
	private array $arFeedInfo;
	
	private int $iblockIdCatalog;
	
	public function __construct(ImportHelper $importHelper, TableLogger $logger, FeedParserInterface $feedParser)
	{
		$this->importHelper = $importHelper;
		$this->logger = $logger;
		$this->feedParser = $feedParser;
		$this->obElement = $this->obElement = new \CIBlockElement();
		$this->iblockIdCatalog = Core::getInstance()->getIblockId($feedParser::IBLOCK_CODE_CATALOG_NEW);
	}
	
	public function importFeed(int $feedId): void
	{		
		$this->feedId = $feedId;
		try {
			$this->arFeedInfo = $this->importHelper->getFeedInfo($this->feedId);
			$this->fileParser = $this->importHelper->getFileParserInterface((int)$this->arFeedInfo['UF_FILE_ID']);
			$this->feedParser->setFileParser($this->fileParser);
			$this->feedParser->parseFeedToTable($this->arFeedInfo);
			$this->importItems();
		} catch (Exception $e) {
			$this->logger->addToLog('feed import', 'error', ['msg' => $e->getMessage(), 'feed_id' => $this->feedId]);
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	* Импортируем товары из временной таблицы
	*/
	private function importItems(): void
	{
		$resItems = FeedsImportTempTable::getList([
			'select' => ['*'],
			'filter' => ['feed_id'=> (int)$this->arFeedInfo['UF_FILE_ID']]
		]);

		$count = 0;

		while ($row = $resItems->fetch()) {
			$arElementFounded = $this->findElement($row['ekn']);
			if ($row['errors'] != '') {
				continue;
			}

			if (!empty($arElementFounded)) {
				$this->updateElement($arElementFounded['ID'], $row);
			} else {
				$this->addElement($row);
			}

			$count++;
		}

		$this->countItems = $count;
	}


	private function findElement(string $ekn): array
	{
		/*
		* Некоторая логика по поиску сущестующих элементов каталога
		*/
		return $arElement;
	}


	private function updateElement(int $id, array $row): void
	{
		/*
		* Некоторая логика по подготовке данных для обновления существующего элемента каталога
		*/
		$this->obElement->SetPropertyValues($id, $this->iblockIdCatalog, $arPropertyValues);
		$this->obElement->Update($arFields);
	}


	private function addElement(array $row): bool
	{
		/*
		* Некоторая логика по подготовке данных для добавления нового элемента в каталог
		*/
		$this->obElement->Add($arFields);
	}
	
}