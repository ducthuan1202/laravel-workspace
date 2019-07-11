<?php

namespace App\Entities;

use App\Admin;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;


/**
 * Class Product
 * @package App\Entities
 * --------------------------------------
 * @property integer id
 *
 * @property integer category_id
 * @property integer created_by
 * @property string name
 * @property string slug
 * @property string price
 * @property string views
 * @property string is_feature
 * @property integer status
 *
 * @property string created_at
 * @property string updated_at
 *
 * @property Category category
 * @property Admin admin
 */
class Product extends BaseModel
{
    protected $perPage = 50;

    /**
     * Trạng thái của kích hoạt và tạm ngưng của sản phẩm
     */
    const
        STATUS_ACTIVATE = 1,
        STATUS_DEACTIVATE = 0;

    /**
     * Giá trị đánh dấu cho dản phẩm
     */
    const
        IS_FEATURE = 1,
        IS_NOT_FEATURE = 0;

    public $casts = [
        'is_feature' => 'boolean',
        'status' => 'boolean',
    ];

    /** @var string $table */
    protected $table = 'products';

    /** @var array $fillable */
    protected $fillable = ['created_by', 'category_id', 'name', 'slug', 'price', 'views'];

    /*
    |--------------------------------------------------------------------------
    | QUAN HỆ GIỮA CÁC MODEL
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    /**
     * Hàm đặc biệt, kế thừa từ parent class
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

        /** Sử dụng 1 class làm đối số cho scope global */
        static::addGlobalScope(new OwnerScope());

        /** Thêm 1 scope global với Closures function */
        static::addGlobalScope('withRelationship', function (Builder $builder) {
            $builder->with(['admin', 'category']);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE TRUY VẤN CỤC BỘ
    |--------------------------------------------------------------------------
    */

    /**
     * Khi cột updated_at có giá trị và khác với cột created_at, có nghĩa là đã được updated
     *
     * @param Builder $query
     */
    public function scopeHasUpdated(Builder $query)
    {
        $query->whereNotNull('updated_at');
    }

    /*
    |--------------------------------------------------------------------------
    | TRUY VẤN DỮ LIỆU
    |--------------------------------------------------------------------------
    */

    /**
     * @param $params
     * @return mixed
     */
    public function search($params = [])
    {

        $query = self::latest();

        # lọc theo từ khóa
        if ($keyword = (string)Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', "%{$keyword}%");
        }

        # lọc theo trạng thái
        $status = Arr::get($params, 'status');
        if (strlen($status)) {
            $query = $query->where('status', (boolean)$status);
        }

        # lọc theo đánh dấu nổi bật
        $feature = Arr::get($params, 'feature');
        if (strlen($feature)) {
            $query = $query->where('is_feature', (boolean)$feature);
        }

        return $query->paginate();
    }

    /**
     * @param bool $addAll
     * @return array
     */
    public function listStatus($addAll = false)
    {
        $list = [
            self::STATUS_DEACTIVATE => 'Tạm ngưng',
            self::STATUS_ACTIVATE => 'Hoạt động',
        ];

        if ($addAll === true) {
            return collect($list)->prepend('Chọn trạng thái', '');
        }
        return $list;
    }

    /**
     * @param bool $addAll
     * @return array|\Illuminate\Support\Collection
     */
    public function listFeature($addAll = false)
    {
        $list = [
            self::IS_FEATURE => 'Nổi bật',
            self::IS_NOT_FEATURE => 'Bình thường',
        ];

        if ($addAll === true) {
            return collect($list)->prepend('Đánh dấu nổi bật', '');
        }
        return $list;
    }

    /*
    |--------------------------------------------------------------------------
    | ĐỊNH DẠNG DỮ LIỆU KHI TRUY XUẤT
    |--------------------------------------------------------------------------
    */

    /**
     * @param string $default
     * @return mixed|string
     */
    public function formatStatus($default = 'không xác định')
    {
        $list = $this->listStatus();

        if (Arr::has($list, (int)$this->status)) {
            return $list[$this->status];
        }

        return $default;
    }

    /**
     * @param string $default
     * @return string
     */
    public function formatFeature($default = 'bình thường')
    {
        if ($this->is_feature) {
            return sprintf('<span class="badge badge-subtle badge-warning" style="width: 150px"><i class="icofont-check"></i> Nổi bật </span>');
        }
        return sprintf('<span class="badge badge-subtle badge-success" style="width: 150px"><i class="icofont-close"></i> %s </span>', $default);
    }

}
