<?php


namespace MySite\app\Features\FastFood\Contracts;

/**
 * Class StatusConstants
 * @package MySite\app\Features\FastFood\Contracts
 */
interface StatusConstants
{

    public const NOT_STARTED = 0;

    public const READY_FOR_COOKING = 1;

    public const COOKING = 2;

    public const DONE = 3;

    public const FAILED = 4;
}
