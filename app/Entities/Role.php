<?php

namespace App\Entities;

use App\Admin;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class Role
 * @package App\Entities
 * ----------------------------------------------------
 *
 * @property string name
 * @property string description
 *
 */
class Role extends BaseModel
{

    /** @var string $table */
    protected $table = 'roles';

    /** @var array $fillable */
    protected $fillable = ['name', 'description'];

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
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')->withPivot(['permission_id', 'role_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();
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


    public function parentList(){
        return self::whereNull('parent_id')->get();
    }

    public function parentListArray(){
        return $this->parentList()->pluck('name', 'id')->prepend('--- Chọn danh mục ---', '');
    }
    /*
    |--------------------------------------------------------------------------
    | ĐỊNH DẠNG DỮ LIỆU KHI TRUY XUẤT
    |--------------------------------------------------------------------------
    */

    public function formatIsActivate(){
        if($this->is_activate){
            return 'kích hoạt';
        }

        return 'tạm khóa';
    }

    public function formatHtmlIsActivate(){
        if($this->is_activate){
            return sprintf('<button class="btn btn-sm btn-info">Kích hoạt</button>');
        }

        return sprintf('<button class="btn btn-sm btn-secondary">Tạm khóa</button>');
    }

}
