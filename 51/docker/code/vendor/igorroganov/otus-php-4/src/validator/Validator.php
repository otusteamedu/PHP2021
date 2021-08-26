<?php
namespace App\validator;

class Validator
{
    public function checkEmail(Array $emails) {

        $emails = filter_var_array($emails, FILTER_VALIDATE_EMAIL);

        return $this->EmailValidateByMxDomain($emails);
    }

    function EmailValidateByMxDomain(Array $emails){

        foreach ( $emails as $email ){

            $domain = substr(strrchr($email, "@"), 1);
            $res = getmxrr($domain, $mx_records, $mx_weight);


            if (false == $res || 0 == count($mx_records) || (1 == count($mx_records) && ($mx_records[0] == null  || $mx_records[0] == "0.0.0.0" ) ) ){
                throw new \Exception('не найдены записи для'.$email);
            }else{

                $tmp_emails[] = $email;
            }
        }
        return $tmp_emails;
    }
}