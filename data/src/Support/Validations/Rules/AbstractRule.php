<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Class AbstractRule
 * @package Yu2ry\Support\Validations\Rules
 */
abstract class AbstractRule implements RuleContract
{

    /**
     * @var RuleData
     */
    protected $data;

    /**
     * RuleEmail constructor.
     * @param RuleData $data
     */
    public function __construct(RuleData $data)
    {
        $this->data = $data;
    }

    /**
     * @param RuleData $data
     * @return static
     */
    public static function factory(RuleData $data): self
    {
        return new static($data);
    }
}