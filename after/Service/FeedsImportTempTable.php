<?php

namespace Core\Import\Service;

use Bitrix\Main\Entity;

class FeedsImportTempTable extends Entity\DataManager
{
	public static function addFeedData(array $arFeedData, int $feedId): void
	{
		foreach ($arFeedData as $row) {
			/**
			* некоторая логика по добавлению данных фида в таблицу временных данных
			*/
		}
	}

}
