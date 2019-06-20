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
 */
class Product extends BaseModel
{

    const STATUS_ACTIVATE = 1;

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
    |
    | Định nghĩa quan hệ giữa các model tại đây.
    | Lưu ý: chỉ viết các hàm như: hasOne, hasMany, belongsTo
    |
    */

    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

    }

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
     * @param Builder $query
     * @param int $numberDay
     */
    public function scopeFromDays(Builder $query, int $numberDay = 30)
    {
        $query->where('created_at', '>', Carbon::now()->startOfDay()->subDays($numberDay));
    }


    /*
    |--------------------------------------------------------------------------
    | TRUY VẤN DỮ LIỆU
    |--------------------------------------------------------------------------
    |
    | Các hàm truy vấn dữ liệu sẽ thực hiện ở đây.
    | Lưu ý: chỉ viết các hàm truy vấn dữ liệu (SELECT) ở đây
    |
    */
    /**
     * @param $params
     * @return mixed
     */
    public function search($params)
    {

        $query = self::oldest('id')->fromDays(2);

        # lọc theo từ khóa
        if (Arr::get($params, 'keyword')) {
            $query = $query->where('name', 'LIKE', '%' . Arr::get($params, 'keyword') . '%');
        }

        return $query->paginate();
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
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsFeatureAttribute($value)
    {
        if ($value) {
            return 'NỔI BẬT';
        }
        return '';
    }
}
