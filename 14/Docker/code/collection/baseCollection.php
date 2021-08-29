<?php

namespace collection\baseCollection;

class baseCollection
{
    private $_members = array();

    public function addItem($obj, $key = null) {
        if($key) {
            if(isset($this->_members[$key])) {
                throw new KeyInUseException("Key \"$key\" already in use!");
            } else {
                $this->_members[$key] = $obj;
            }
        } else {
            $this->_members[] = $obj;
        }
    }

    public function removeItem($key) {
        if(isset($this->_members[$key])) {
            unset($this->_members[$key]);
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }
    }
    public function getItem($key) {
        if(isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }
    }

    public function length() {
        return sizeof($this->_members);
    }

}