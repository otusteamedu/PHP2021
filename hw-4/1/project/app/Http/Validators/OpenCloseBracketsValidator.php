<?php

namespace App\Http\Validators;

class OpenCloseBracketsValidator extends BaseValidator
{
    public function validate()
    {
        $set_brackets = str_split($this->field);
        $left_bracket = [];
        $right_bracket = [];
        foreach ($set_brackets as $key => $bracket) {
            if ($bracket == "(") {
                $left_bracket[$key] = $bracket;
            } else {
                $right_bracket[$key] = $bracket;
            }
        }
        foreach ($left_bracket as $key_l_b => $value_l_b) {
            foreach ($right_bracket as $key_r_b => $value_r_b) {
                if ($key_r_b < $key_l_b) {
                    return false;
                } else {
                    unset($left_bracket[$key_l_b]);
                    unset($right_bracket[$key_r_b]);
                    break;
                }
            }
        }

        if (empty($left_bracket) && empty($right_bracket)) {
            return true;
        }

        return false;
    }
}