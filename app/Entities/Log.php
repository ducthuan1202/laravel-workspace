<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class Log
 * @package App\Entities
 * --------------------------------------
 * @property integer id
 *
 * @property integer created_by
 * @property string name
 * @property string content
 * @property string action
 * @property string old_data
 *
 * @property string created_at
 * @property string updated_at
 */
class Log extends BaseModel
{
    const
        ACTION_CREATE = 1,
        ACTION_UPDATE = 2,
        ACTION_DELETE = 3;

    /** @var string $table */
    protected $table = 'logs';

    /** @var array $fillable */
    protected $fillable = ['created_by', 'name', 'content', 'action', 'old_data'];

    public $casts = [
        'old_data' => 'json'
    ];

    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

        /** Khi dữ liệu được get từ db */
        static::retrieved(function (Log $log) {
            // gọi khi model được get từ database ra
        });

        /** Tạo mới (chưa lưu) */
        static::creating(function (Log $log) {
            $log->created_by = auth()->id();
        });

        /** Khi tạo mới thành công (đã lưu) */
        static::created(function (Log $log) {
            // afterCreate()
            // $model->slug = Str::slug($category->name);
        });

        /** Update dữ liệu (chưa lưu) */
        static::updating(function (Log $log) {
            // beforeUpdate()
        });

        /** Update dữ liệu thành công (đã lưu) */
        static::updated(function (Log $log) {
            // afterUpdate()
        });

        /** Thực hiện trước khi xóa */
        static::deleting(function (Log $log) {
            // beforeDelete()
        });

        /** Thực hiện khi xóa thành công */
        static::deleted(function (Log $log) {
            // afterDelete()
        });
    }

    /**
     * @param Builder $query
     * @param int $numberDay
     */
    public function scopeFromDays(Builder $query, int $numberDay = 30)
    {
        $query->whereDate('created_at', '>', now()->startOfDay()->subDays($numberDay));
    }

    /*
    |--------------------------------------------------------------------------
    | TRUY VẤN DỮ LIỆU
    |--------------------------------------------------------------------------
    |
    */

    /**
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {

        /** @var Builder $query */
        $query = self::latest();

        # lọc theo trạng thái
        if ($status = (string)Arr::get($params, 'action')) {
            $query = $query->where('action', strtoupper($status));
        }

        # lọc theo ngày
        if (Arr::get($params, 'date')) {

            [$startDate, $endDate] = explode(' - ', Arr::get($params, 'date'));

            if($startDate && $endDate){

                $inputFormat = 'd/m/Y';
                $outputFormat = 'Y-m-d H:i:s';

                $query = $query->whereBetween('created_at', [
                    Carbon::createFromFormat($inputFormat, $startDate)->startOfDay()->format($outputFormat),
                    Carbon::createFromFormat($inputFormat, $endDate)->endOfDay()->format($outputFormat)
                ]);
            }

        }

        return $query->paginate();

    }

    /**
     * @param bool $addAll
     * @return array|\Illuminate\Support\Collection
     */
    public function listAction($addAll = false)
    {

        $list = [
            self::ACTION_CREATE => 'CREATE',
            self::ACTION_UPDATE => 'UPDATE',
            self::ACTION_DELETE => 'DELETE',
        ];

        if ($addAll === true) {
            return collect($list)->prepend('Chọn kiểu log', '');
        }
        return $list;

    }

    /*
    |--------------------------------------------------------------------------
    | ĐỊNH DẠNG DỮ LIỆU KHI TRUY XUẤT
    |--------------------------------------------------------------------------
    */

    /**
     * @param string $color
     * @return string
     */
    public function formatClassLog($color = '#fff')
    {
        $action = (string)strtoupper($this->action);
        switch ($action) {
            case self::ACTION_CREATE:
                $color = '#eef9e1';
                break;
            case self::ACTION_UPDATE:
                $color = '#e7fcff';
                break;
            case self::ACTION_DELETE:
                $color = '#fff4e3';
                break;
            default:
                break;
        }

        return $color;
    }

    /**
     * @param string $default
     * @return mixed|string
     */
    public function formatAction($default = 'unknown')
    {
        $listActions = collect($this->listAction());

        if ($listActions->has($this->action)) {
            return $listActions[$this->action];
        }

        return $default;
    }
}
