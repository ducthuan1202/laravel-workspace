<?php

namespace App\Entities;

use App\Scopes\CreateByMeScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

        /** Thêm 1 scope query toàn cục cho model */
        static::addGlobalScope(new CreateByMeScope());
    }

    /**
     * Thêm 1 scope query dạng địa phương
     *
     * @param Builder $query
     * @param int $numberDay
     */
    public function scopeFromDays(Builder $query, int $numberDay = 30)
    {
        $query->where('created_at', '>', Carbon::now()->startOfDay()->subDays($numberDay));
    }

    public function list(){
        return self::all();
    }
}
