<?php

class Validator {

    const mask = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

    public function check($email_data): bool {
        // Works with single string and array of strings;
        if (is_array($email_data)) {
            foreach ($email_data as $email) {
                $this->check($email);
            }
        } else {
            if (empty($email_data)) {
                throw new \Exception('Empty email');
            }
            if (!preg_match(self::mask, $email_data)) {
                throw new \Exception('Wrong email ' . $email_data);
            }
            $this->mxhost_check($email_data);
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
                throw new \Exception('Wrong host ' . $domain .' in '.$email_data);
            }
        }
    }

}
