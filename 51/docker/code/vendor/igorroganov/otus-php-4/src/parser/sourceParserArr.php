<?php
namespace App\parser;
use App\source\emailSource;
class sourceParserArr{

    public function parseEmailSource(emailSource $source):array {

        return $source->getResource();

    }
}
?>