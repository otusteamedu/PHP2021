<?php

namespace Core\Import\FileParser;

use Core\Import\Service\FeedsImportTempTable;

interface FileParserInterface
{
	
	public function run(): void;
	
	public function getErrors(): array;
	
}