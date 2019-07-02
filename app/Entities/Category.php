<?php

namespace App\Entities;

use App\Admin;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class Category
 * @package App\Entities
 * --------------------------------------
 * @property integer id
 *
 * @property integer created_by
 * @property string name
 * @property string slug
 * @property string image
 * @property integer is_activate
 *
 * @property string created_at
 * @property string updated_at
 *
 * @property Product[] products
 * @property Admin admin
 */
class Category extends BaseModel
{

    const
        STATUS_PENDING = 1,
        STATUS_APPROVED = 2,
        STATUS_CANCEL = 3;

    public $casts = [
        'is_activate' => 'boolean'
    ];

    /** @var string $table */
    protected $table = 'categories';

    /** @var array $fillable */
    protected $fillable = ['created_by', 'name', 'slug', 'image', 'is_activate'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
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

        /** Thêm 1 scope query toàn cục cho model */
        static::addGlobalScope(new OwnerScope());

        /** Thêm 1 scope global với Closures function */
        static::addGlobalScope('withRelationship', function (Builder $builder) {
            $builder->with(['admin']);
        });

    }

    /**
     * Thêm 1 scope query dạng địa phương
     *
     * @param Builder $query
     * @param int $numberDay
     */
    public function scopeFromDays(Builder $query, int $numberDay = 30)
    {
        $query->whereDate('created_at', '>', now()->startOfDay()->subDays($numberDay))->where('created_at', '<', now());
    }

    /*
    |--------------------------------------------------------------------------
    | TRUY VẤN DỮ LIỆU
    |--------------------------------------------------------------------------
    |
    */

    public function search($params = [])
    {

        # sử dụng truy vấn với scope địa phương
        $query = $this;

        # lọc theo từ khóa
        if ($keyword = Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', "%{$keyword}%");
        }

        return $query->oldest()->paginate();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return Category::count();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getData($params = [])
    {

        # sử dụng truy vấn với scope địa phương
        $query = $this;

        # lọc theo từ khóa
        if ($keyword = Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', "%{$keyword}%");
        }

        return $query->oldest()->paginate();
    }

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return self::all();
    }


}
