<?php

namespace Core\Import\Service;

use Bitrix\Main\Entity;

class FeedsImportTempTable extends Entity\DataManager
{
	public static addFeedData(array $arFeedData): void
	{
		foreach ($arFeedData as $row) {
			/**
			* некоторая логика по добавлению данных фида в таблицу временных данных
			*/
		}
	}
	
}