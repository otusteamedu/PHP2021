<?php

declare(strict_types=1);

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;


    /**
     * @param bool $cutDeleted
     * @return Builder|Model
     */
    protected function startCondition(bool $cutDeleted = true): Builder|Model
    {
        $clone = clone $this->model;
        unset($this->model);
        return $clone;
    }
}
