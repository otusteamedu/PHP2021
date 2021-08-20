<?php

declare(strict_types=1);

namespace MySite\app\Services;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractFeature
 * @package MySite\app\Features
 */
abstract class AbstractService
{

    /**
     * @var array
     */
    protected array $queryParams = [];

    /**
     * AbstractFeature constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(
        protected ServerRequestInterface $request
    ) {
        $this->queryParams = $this->request->getQueryParams();
    }

    /**
     * @return object|null
     */
    abstract public function run(): ?object;
}
