<?php

namespace App\Repositories;

/**
 * Class RepositoryAbstract
 * @package App\Repositories
 * ----------------------------------------
 *
 * @property \Eloquent model
 */
abstract class RepositoryAbstract
{
    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this->getModel();
    }

}
