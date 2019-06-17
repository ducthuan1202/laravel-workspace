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
 *
 * @property string created_at
 * @property string updated_at
 */
class Log extends BaseModel
{
    const
        ACTION_CREATE = 'CREATE',
        ACTION_UPDATE = 'UPDATE',
        ACTION_DELETE = 'DELETE';

    /** @var string $table */
    protected $table = 'logs';

    /** @var array $fillable */
    protected $fillable = ['created_by', 'name', 'content', 'action'];

    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

        /**
         * thực hiện trước khi model->save();
         * Có thể sự dụng Observer nếu như có nhiều sự kiện
         */
        static::creating(function (Log $log) {
            $log->created_by = 1;
        });

    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActionType(Builder $query, string $type = 'CREATE')
    {
        $query->where('action', strtoupper($type));
    }

    /**
     * @return string
     */
    public function formatClassLog()
    {
        switch ($this->action) {
            case self::ACTION_CREATE:
                return '#c4d8ad';
                break;
            case self::ACTION_UPDATE:
                return '#afccd0';
                break;
            case self::ACTION_DELETE:
                return '#e8cda4';
                break;
            default:
                return '#fff';
                break;
        }
    }
}
