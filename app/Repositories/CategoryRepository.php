<?php

namespace App\Repositories;

use App\Entities\Category;

class CategoryRepository extends RepositoryAbstract
{

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->setModel($category);
    }

    /**
     * Scope search with parameters
     *
     * @param array $params
     * @return mixed
     */
    public function scopeSearch($params = [])
    {
        $query = $this->getModel();

        if (array_key_exists('keyword', $params) && !empty($params['keyword'])) {
            $query = $query->where('name', 'LIKE', '%' . $params['keyword'] . '%');
        }

        return $query;
    }

    /**
     * Search data by parameters
     *
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {
        return $this->scopeSearch($params)->latest()->paginate($this->model->getPerPage());
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->getModel()->count();
    }

}
