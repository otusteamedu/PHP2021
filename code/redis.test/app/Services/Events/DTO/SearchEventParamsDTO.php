<?php

declare(strict_types=1);

namespace App\Services\Events\DTO;

use App\Services\Events\DTO\Exceptions\SearchEventParamsFromArrayException;

final class SearchEventParamsDTO
{

    /**
     * @var array
     */
    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param array $data
     * @return static
     * @throws SearchEventParamsFromArrayException
     */
    public static function fromArray(array $data): self
    {
        if (
            !isset($data['params'])
            || !(is_array($data['params']))
        ) {
            throw new SearchEventParamsFromArrayException('Неверный формат входных данных! '
                . '(Пример: {"params": { "param1": 1, "param2": 2 }})');
        }
        return new static($data['params']);
    }

    public function getParams(): array
    {
        return $this->params;
    }

}
