<?php


class Config {

    const path_to_config = '/../config.ini';

    protected $data;

    public function __construct() {
        $this->data=[];
        $data_file = file(__DIR__ . self::path_to_config);
        foreach ($data_file as $line) {
            if ($line) {
                $values=explode("=",$line);
                if (count($values)==2) {
                    $this->data[trim($values[0])]=trim($values[1]);
                }
            }
        }
    }

    public function getPortConfig() {
        return $this->data["server_address"];
    }
    public function getStopword() {
        return $this->data["stop_word"];
    }

}
