<?php

namespace App\Entities;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Entities
 * ----------------------------------------------------
 * @property integer id
 * @property integer created_by
 *
 * @property string created_at
 * @property string updated_at
 *
 * @property Admin admin
 */
class BaseModel extends Model
{

    const
        BOOLEAN_TRUE = 1,
        BOOLEAN_FALSE = 0;

    protected $perPage = 20;

    /**
     * @param string $default
     * @return string
     */
    public function formatCreatedBy($default = 'not set')
    {
        if (isset($this->admin) && $this->admin instanceof Admin) {
            return sprintf('<img src="%s" alt="" class="border border-warning shadow-sm rounded-lg rounded-circle" width="50" height="50">', $this->admin->image);
        }

        return $default;
    }

    /**
     * @param string $default
     * @return string
     */
    public function formatHtmlCreatedBy($default = 'not set')
    {
        if (isset($this->admin) && $this->admin instanceof Admin) {
            if((int)$this->admin->id === auth()->id()){
                return sprintf('<a href="javascript:void(0);">%s <span class="badge badge-dark">bạn</span></a>', $this->admin->name);
            }
            return sprintf('<a href="javascript:void(0);">%s</a>', $this->admin->name);
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
