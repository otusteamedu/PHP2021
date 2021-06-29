<?php


namespace Repetitor202\Domain;


class EventValidator
{
    private const REQUIRED_STORE_PARAMS = [
      'name',
      'priority',
      'conditions',
    ];

    private const  AVAILABLE_SEARCH_CONDITIONS = [
        'param1',
        'param2',
        'param3',
    ];

    public function validateStoreRequest(array $params): void
    {
        $requiredKeys = array_filter(
            $params,
            fn ($key) => in_array($key, self::REQUIRED_STORE_PARAMS),
            ARRAY_FILTER_USE_KEY
        );
        if (
            count($requiredKeys) != count(self::REQUIRED_STORE_PARAMS)
            ||
            gettype($params['name']) !== 'string'
            ||
            ! filter_var($params['priority'], FILTER_VALIDATE_INT)
            ||
            count($this->filterConditionsParams($params['conditions'])) === 0
        ) {
            throw new \Exception('Unvalid query (store-request).');
        }
    }

    public function filterConditionsParams(array $params): ?array
    {
        $filteredByKeys = array_filter(
            $params,
            fn ($key) => in_array($key, self::AVAILABLE_SEARCH_CONDITIONS),
            ARRAY_FILTER_USE_KEY
        );

        $filteredOnlyIntegers = array_filter($filteredByKeys, 'ctype_digit');

        if (count($filteredOnlyIntegers) === 0) {
            throw new \Exception('Unvalid query (conditions).');
        }

        return $filteredOnlyIntegers;
    }
}