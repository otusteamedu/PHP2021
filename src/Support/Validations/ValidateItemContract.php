<?php

namespace Yu2ry\Support\Validations;

use Yu2ry\Support\Validations\Rules\RuleContract;

/**
 * Interface ValidateItemContract
 * @package Yu2ry\Support\Validations
 */
interface ValidateItemContract
{

    /**
     * @return string
     */
    public function getAttr(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return RuleContract
     */
    public function getRule(): RuleContract;
}