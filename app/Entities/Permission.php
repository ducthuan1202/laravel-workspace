<?php

namespace App\Entities;

use App\Admin;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class Permission
 * @package App\Entities
 * ----------------------------------------------------
 *
 * @property string name
 * @property string controller
 *
 */
class Permission extends BaseModel
{

    /** @var string $table */
    protected $table = 'permissions';

    /** @var array $fillable */
    protected $fillable = ['name', 'controller'];

    /*
    |--------------------------------------------------------------------------
    | QUAN HỆ GIỮA CÁC MODEL
    |--------------------------------------------------------------------------
    |
    | Định nghĩa quan hệ giữa các model tại đây.
    | Lưu ý: chỉ viết các hàm như: hasOne, hasMany, belongsTo
    |
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions')->withPivot(['permission_id', 'role_id']);
    }

    /*
    |--------------------------------------------------------------------------
    | TRUY VẤN DỮ LIỆU
    |--------------------------------------------------------------------------
    |
    */

    public function search($params = [])
    {
        $query = $this;

        # lọc theo từ khóa
        if ($keyword = Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', "%{$keyword}%");
        }

        return $query->oldest()->paginate();
    }

    public function list()
    {
        return self::all();
    }

}
