<?php

namespace App\Entities;

use Carbon\Carbon;
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
 */
class Product extends BaseModel
{

    const STATUS_ACTIVATE = 1;
    const STATUS_DEACTIVATE = 0;

    const IS_FEATURE = 1;

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
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
    | Scope truy vấn
    |--------------------------------------------------------------------------
    */

    /**
     * @param Builder $query
     * @param int $numberDay
     */
    public function scopeFromDays(Builder $query, int $numberDay = 30)
    {
        $query->whereDate('created_at', '>', now()->startOfDay()->subDays($numberDay));
    }

    /**
     * @param Builder $query
     */
    public function scopeRelation(Builder $query){
        $query->with(['category']);
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

        $query = self::oldest('id')->relation();

        # lọc theo từ khóa
        if ($keyword = Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        # lọc theo trạng thái
        if ($status = Arr::get($params, 'status')) {
            $query = $query->where('status', $status);
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

    /*
    |--------------------------------------------------------------------------
    | ĐỊNH DẠNG DỮ LIỆU KHI TRUY XUẤT
    |--------------------------------------------------------------------------
    |
    | Định nghĩa quan hệ giữa các model tại đây.
    | Lưu ý: chỉ viết các hàm như: hasOne, hasMany, belongsTo
    |
    */

    /**
     * @return mixed|string
     */
    public function formatStatus()
    {
        $list = $this->listStatus();

        # vì đã cast status sang kiểu boolean, nên ở đây cần convert sang kiểu int
        if (Arr::has($list, (int)$this->status)) {
            return $list[$this->status];
        }

        return 'không xác định';
    }

    /**
     * @return string
     */
    public function formatFeature()
    {
        if ($this->is_feature) {
            return 'NỔI BẬT';
        }
        return 'bình thường';
    }

    /**
     * @return mixed
     */
    public function formatCreatedAt()
    {
        return $this->created_at->format('d/m/Y');
    }

}
