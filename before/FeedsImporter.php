<?php

namespace Core\Import;

use Bitrix\Catalog\Model;
use CFile;
use Core\Import\FeedsImportTempTable;
use Core\Logger\TableLogger;
use Core\Logger\FeedsImporterDebugLogTable;
use Core\Tools\ImportHelper;
use Exception;

define('LOG_FILENAME', "{$_SERVER['DOCUMENT_ROOT']}/bitrix/modules/error.log");

/**
 * Класс-импортер фидов
 * README процесса импорта фида здесь: /readme/backend/catalog_exchange/catalog_exchange.md
 */
class FeedsImporter
{

	private TableLogger $loggerDebug;
    
    private int $iblockIdCatalog;
    
	private CIBlockElement $obElement;
    
    private int $countItems;

	const RECOMMENDED = 'RECOMMENDED';
    const RECOMMENDED_ACTIVE_FROM = 'RECOMMENDED_ACTIVE_FROM';
    const RECOMMENDED_ACTIVE_TO = 'RECOMMENDED_ACTIVE_TO';
    const RECOMMENDED_PROP_ENUM_EXTERNAL_ID = 'Y';

    public function __construct()
    {
        $this->loggerDebug = new TableLogger(new FeedsImporterDebugLogTable());

        $core = Core::getInstance();
        $this->iblockIdCatalog = $core->getIblockId($core::IBLOCK_CODE_CATALOG_NEW);
        $this->obElement = new \CIBlockElement();
    }


    /**
     * @param $feedId
     * ID загруженного файла фида
     * @throws \Bitrix\Main\ObjectException
     */
    public function run(int $feedId): void
    {
        $this->loggerDebug->addToLog('feeds importer', 'start', "feed_id $feedId");

        if ($feedId !== false) {
            try {
                $this->importFeed($feedId);
            } catch (Exception $e) {
                AddMessage2Log($e->getMessage());
                $this->loggerDebug->addToLog('feeds importer', 'critical error', [
                    'feed_id' => $feedId,
                    'msg' => $e->getMessage(),
                ]);
            }
        }

        $this->loggerDebug->addToLog('feeds importer', 'end', '');
    }

    /**
     * Загрузка данных из фида
     * @param $feedId
     * @return bool
     */
    private function importFeed(int $feedId): bool
    {
        if (!$feedId) {
            $this->loggerDebug->addToLog('import feed', 'error', ['msg' => 'incorrect feed id']);
            return false;
        }

        $this->loggerDebug->addToLog('import feed', 'info', ['feed_id' => $feedId, 'msg' => 'start feed import']);

        $arFeed = ImportHelper::getFeedInfo((int)$feedId);
        
		$parser = new FeedParser();
		
        if ($parser === false) {
            return false;
        }

        $parser->parseFeedToTable($arFeed);

        $arErrors = $parser->getErrors();
        if (empty($arErrors['Critical'])) {
            $this->importItems($feedId);

        } else {
			$this->loggerDebug->addToLog('import feed', 'error', ['feed_id' => $feedId, 'msg' => json_encode($arErrors['Critical'], JSON_UNESCAPED_UNICODE)]);
        }

        return true;
    }
    
    /**
     * Импортируем товары из временной таблицы
     * @param $feedId
     */
	 private function importItems($feedId)
    {
        $resItems = FeedsImportTempTable::getList([
            'select' => ['*'],
            'filter' => ['feed_id'=> $feedId]
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


	private function findElement($ekn)
    {
       	/*
       	* Некоторая логика по поиску сущестующих элементов каталога
       	*/
        return $arElement;
    }


	private function updateElement($ID, $row)
    {
		/*
		* Некоторая логика по подготовке данных для обновления существующего элемента каталога
		*/
        $this->obElement->SetPropertyValues($ID, $this->iblockIdCatalog, $arPropertyValues);
		$this->obElement->Update($arFields);
    }
 
 
	private function addElement($row): bool
    {
        /*
        * Некоторая логика по подготовке данных для добавления нового элемента в каталог
        */
		$resId = $this->obElement->Add($arFields);

		return $resId ? true : false;
    }
}
