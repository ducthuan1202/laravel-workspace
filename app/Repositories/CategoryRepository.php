<?php

namespace App\Repositories;

use App\Entities\Category;
use Illuminate\Support\Arr;

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
        if(Arr::get($params, 'keyword')){
            $query = $query->where('name', 'LIKE', '%' . Arr::get($params, 'keyword') . '%');
        }

        return $query->oldest('id')->paginate();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return Category::count();
    }

}
