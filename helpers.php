<?php

/**
 * @param string ...$data
 * @return bool
 */
function email_verify(string ...$data): bool
{
    if (is_string($data)) {
        return is_email($data);
    }

    foreach ($data as $email) {
        if (!is_email($email)) {
            return false;
        }
    }

    return true;
}

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    // filter_var($email, FILTER_VALIDATE_EMAIL); ?
    if (!preg_match(
        '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
        $email
    ) || !getmxrr(explode('@', $email)[1], $hosts)) {
        return false;
    }

    return true;
}
