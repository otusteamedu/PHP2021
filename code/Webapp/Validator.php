<?php

class Validator {

    const mask = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

    public function check($email_data){
        // Works with single string and array of strings;
        if (is_array($email_data)) {
            $result=[];
            foreach ($email_data as $email) {
                
                $result[]=$this->check($email);
            }
            return ($result);
        } else {
            if (empty($email_data)) {
                return ('Empty email');
            }
            if (!preg_match(self::mask, $email_data)) {
                return ('Wrong email ' . $email_data);
            }
            return $this->mxhost_check($email_data);
        }
           return true;
    }

    private function mxhost_check($email_data) {
        $domain = substr($email_data, strrpos($email_data, '@') + 1);
        $mxhosts = array();
        $checkDomain = getmxrr($domain, $mxhosts);
        if (!empty($mxhosts) && strpos($mxhosts[0], 'hostnamedoesnotexist')) {
            array_shift($mxhosts);
        }
        if (!$checkDomain || empty($mxhosts)) {
            $dns = @dns_get_record($domain, DNS_A);
            if (empty($dns)) {
                return ('Wrong host ' . $domain .' in '.$email_data);
            }
        }
        return true;
    }

}
