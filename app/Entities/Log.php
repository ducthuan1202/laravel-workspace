<?php

namespace App\Entities;

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
        ACTION_CREATE = 'create',
        ACTION_UPDATE = 'update',
        ACTION_DELETE = 'delte';

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

        /** beforeCreate */
        static::creating(function (Log $log) {
            $log->created_by = 1;
        });

    }
}
