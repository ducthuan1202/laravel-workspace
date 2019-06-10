<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected $perPage = 50;

    /**
     * @param $id
     * @param array $relations
     * @return BaseModel|BaseModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function findByCode($id, $relations = [])
    {
        if (!empty($relations) && is_array($relations)) {
            return $this->with($relations)->find($id);
        }

        return $this->find($id);
    }

    /**
     * @param mixed $value
     * @return BaseModel|BaseModel[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null|void
     */
    public function resolveRouteBinding($value)
    {
        return $this->findByCode($value) ?? abort(404);
    }
}
