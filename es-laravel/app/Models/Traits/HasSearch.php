<?php
/**
 * Description of HasSearch.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Models\Traits;


use App\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasSearch
 * @package App\Models\Traits
 * @mixin Model
 */
trait HasSearch
{
    public function bootSearchable()
    {
        if (config('services.search.enabled')){
            static::observe(ArticleObserver::class);
        }
    }
    public function getSearchIndex(): string
    {
        return $this->getTable() . '_index';
    }

    public function getSearchType(): string
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable() . '_index';
    }

    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
