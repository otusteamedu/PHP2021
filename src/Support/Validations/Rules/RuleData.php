<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Class RuleData
 * @package Yu2ry\Support\Validations\Rules
 */
class RuleData
{

    /**
     * @var string $attr
     */
    protected $attr;

    /**
     * @var mixed $value
     */
    protected $value;

    /**
     * ValidateItemAbstract constructor.
     * @param string $attr
     * @param mixed $value
     */
    public function __construct($value, string $attr = '')
    {
        $this->attr = $attr;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getAttr(): string
    {
        return $this->attr;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}