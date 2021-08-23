<?php

namespace MySite\app\Support\Contracts;

/**
 * Interface DatabaseQuery
 * @package MySite\app\Support\Contracts
 */
interface DatabaseQuery
{

    /**
     * @param array|null $data
     * @return bool
     */
    public function create(?array $data): bool;

    /**
     * @param array|null $data
     * @return bool
     */
    public function delete(?array $data): bool;

    /**
     * @param array|null $data
     * @return array|null
     */
    public function get(?array $data): ?array;

    /**
     * @return bool
     */
    public function clear(): bool;

    /**
     * @param array|null $data
     * @return array|null
     */
    public function search(?array $data): ?array;
}
