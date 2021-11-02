<?php

$list = ['test@mail.ru', 'test@qwerty.en', 'test@lorem.ipsum'];

function validateEmail(array $list) {
    $validEmails = [];

    foreach ($list as $email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            list(,$domain) = explode('@', $email);
            if (checkdnsrr($domain, 'MX')) $validEmails[] = $email;
        }
    }

    return $validEmails;
}

var_dump(validateEmail($list));