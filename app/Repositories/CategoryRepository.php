<?php

namespace App\Repositories;

use App\Entities\Category;

class CategoryRepository
{

    /**
     * Search data by parameters
     *
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {

        # sử dụng truy vấn với scope địa phương
        $query = Category::fromDays(2);

        # lọc theo từ khóa
        if (array_key_exists('keyword', $params) && !empty($params['keyword'])) {
            $query = $query->where('name', 'LIKE', '%' . $params['keyword'] . '%');
        }

        return $query->latest()->paginate();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return Category::count();
    }

}
