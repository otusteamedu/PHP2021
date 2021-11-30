<?php
namespace App\Traits;

use App\Observers\ElasticSearch;

trait Searchable
{
    public static function bootSearchable()
    {
        // Это облегчает переключение флага поиска.
        // Будет полезно позже при развертывании
        // новой поисковой системы в продакшене
        if (config('services.search.enabled')) {
            static::observe(ElasticSearch::class);
        }
    }
    public function getSearchIndex()
    {
        return $this->getTable();
    }
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    public function toSearchArray()
    {
        // Наличие пользовательского метода
        // преобразования модели в поисковый массив
        // позволит нам настраивать данные
        // которые будут доступны для поиска
        // по каждой модели.
        return $this->toArray();
    }
}