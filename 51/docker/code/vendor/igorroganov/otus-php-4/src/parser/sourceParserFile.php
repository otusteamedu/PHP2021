<?php
namespace App\parser;
use App\source\emailSource;
class sourceParserFile{

    public function parseEmailSource(emailSource $source):array {
        return file($source->getResource());
    }
}
?>