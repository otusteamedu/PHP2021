<?php

namespace controllers;

class App {

    public function run() {
        $config = new \Config;

        while ($string_to_send = readline() ) {
            $fp = stream_socket_client($config->getPortConfig(), $errno, $errstr, 30);
            if (!$fp) {
                throw new \Exception("$errstr ($errno)<br />\n");
            } else {
                fwrite($fp, $string_to_send);
                while (!feof($fp)) {
                    echo fgets($fp, 1024);
                }
                fclose($fp);
            }
            if ($string_to_send== $config->getStopword()) {
                break;
            }
        }
    }

}
