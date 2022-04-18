<?php

namespace Core\Import\FileParser;

use Core\Import\Service\FeedsImportTempTable;

interface FileParserInterface
{

	public function run(int $userId, int $feedId, string $filePath): void;

	public function getErrors(): array;

}
