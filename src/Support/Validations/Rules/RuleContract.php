<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Interface RuleContract
 * @package Yu2ry\Support\Validations\Rules
 */
interface RuleContract
{

    /**
     * @return bool
     */
    public function check(): bool;

    /**
     * @return string
     */
    public function message(): string;
}