<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    //

    /**
     * Create new record from model
     *
     * @param Model $model
     * @return Model
     */
    protected function createFromModel(Model $model): Model
    {
        $_data = $this->prepareCreate($model);

        return $model::create($_data);
    }

    /**
     * Prepare data create
     *
     * @param Model $model
     * @return array
     */
    protected function prepareCreate(Model $model): array
    {
        $_data = [];

        foreach ($model->getFillable() as $key => $attribute) {
            $_data[$attribute] = $model->__get($attribute);
        }

        return $_data;
    }
}
