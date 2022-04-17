<?php

namespace Sitecore\Import\FeedParsers;

use Core\Logger\TableLogger;
use Core\Import\FileParser\FileParserInterface;

interface FeedParserInterface
{
	
	public function __construct(TableLogger $logger);

	public function parseFeedToTable(array $arFeed): void;

	public function getFileParser(): FileParserInterface;
	
	public function setFileParser(FileParserInterface $fileParser): void;
	
	public function getErrors(): array;
	
}
