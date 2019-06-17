<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;

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
            $log->created_by = 1;
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
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActionType(Builder $query, string $type = self::ACTION_CREATE)
    {
        $query->where('action', strtoupper($type));
    }

    /**
     * @return array
     */
    public function listAction(){
        return [
            self::ACTION_CREATE => 'CREATE',
            self::ACTION_UPDATE => 'UPDATE',
            self::ACTION_DELETE => 'DELETE',
        ];
    }
    /**
     * @return string
     */
    public function formatClassLog()
    {
        switch ($this->action) {
            case self::ACTION_CREATE:
                return '#eef9e1';
                break;
            case self::ACTION_UPDATE:
                return '#e7fcff';
                break;
            case self::ACTION_DELETE:
                return '#fff4e3';
                break;
            default:
                return '#fff';
                break;
        }
    }

    /**
     *
     */
    public function formatAction(){
        $listActions = collect($this->listAction());

        if($listActions->has($this->action)){
            return $listActions[$this->action];
        }

        return '';
    }
}
