<?php

namespace controllers;

class App {

    public function run() {
        $config=new \Config;
        $socket = stream_socket_server($config->getPortConfig(), $errno, $errstr);
        if (!$socket) {
             throw new \Exception("$errstr ($errno)<br />\n");
        } else {
            while ($conn = stream_socket_accept($socket)) {
                $data=fread($conn, 1500) ;
                if ($data==$config->getStopword()) {
                    break;
                }
                if (is_string($data) ) fwrite($conn, "Received ".strlen($data)." bytes \n");
                echo $data."\n";
                
                fclose($conn);
            }
            fclose($socket);
        }
    }

}
