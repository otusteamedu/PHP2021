<?php

namespace App\Http\Validators;

class OpenCloseBracketsValidator extends BaseValidator
{
    public function validate()
    {
        $s = str_split($this->field);
        $left_skob = [];
        $right_skob = [];
        foreach ($s as $key => $skob) {
            if ($skob == "(") {
                $left_skob[$key] = $skob;
            } else {
                $right_skob[$key] = $skob;
            }
        }
        foreach ($left_skob as $key_l_s => $value_l_s) {
            foreach ($right_skob as $key_r_s => $value_r_s) {
                if ($key_r_s < $key_l_s) {
                    return false;
                } else {
                    unset($left_skob[$key_l_s]);
                    unset($right_skob[$key_r_s]);
                    break;
                }
            }
        }

        if (empty($left_skob) && empty($right_skob)) {
            return true;
        }

        return false;
    }
}