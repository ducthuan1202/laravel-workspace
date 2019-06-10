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
    /** @var mixed $model */
    public $model;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this->getModel();
    }

}