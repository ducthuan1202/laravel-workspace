<?php

namespace App\Entities;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Entities
 *
 * @property string created_at
 * @property string updated_at
 */
class BaseModel extends Model
{

    protected $perPage = 100;


    /**
     * @param string $default
     * @return string
     */
    public function formatCreatedBy($default = 'not set')
    {
        if (isset($this->admin) && $this->admin instanceof Admin) {
            return $this->admin->name;
        }

        return $default;
    }

    /**
     * @param string $format
     * @return mixed
     */
    public function formatCreatedAt($format = 'd/m/Y')
    {
        return $this->created_at->format($format);
    }

}
