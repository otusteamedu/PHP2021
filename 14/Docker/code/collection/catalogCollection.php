<?php
namespace collection\catalogCollection;

use collection\baseCollection;

class catalogCollection extends baseCollection
{
    public function addItem(Catalog $obj, $key = null) {
        parent::addItem($obj, $key);
    }

}