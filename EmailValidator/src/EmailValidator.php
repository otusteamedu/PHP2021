<?php

Class EmailValidator {
    protected array $ports = [25, 587];
    protected array $valid;

    public function __construct() {

    }

    public function check($email): bool {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hostname = explode("@", $email)[1];
            
            if (!isset($this->valid[$hostname])) {
                getmxrr($hostname, $mx);
                if (empty($mx)) {
                    $mx[] = $hostname;
                }
    
                for ($i=0; $i < count($mx); $i++) {
                    for ($j=0; $j < count($this->ports); $j++) { 
                        $fp = @fsockopen($mx[$i], $this->ports[$j], $errno, $errstr, 1);
                        if ($fp) {
                            $this->valid[$hostname] = true;
                            fclose($fp);
                            return true;
                        }
                    }
                }
    
                $this->valid[$hostname] = false;
            } else {
                return $this->valid[$hostname];
            }
        }

        return false;
    }

    public function __destruct() {
            
    }
    
}