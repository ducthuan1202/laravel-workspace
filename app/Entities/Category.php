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
 *
 * @property string created_at
 * @property string updated_at
 */
class Category extends BaseModel
{
    /** @var string $table */
    protected $table = 'categories';

    /** @var array $fillable */
    protected $fillable = ['created_by', 'name', 'slug', 'image'];


    /**
     * Thực hiện các hành động theo event của eloquent model
     */
    public static function boot()
    {
        parent::boot();

        /**
         * Thêm 1 scope query toàn cục cho model
         */
        static::addGlobalScope(new CreateByMeScope());

        /** Khi dữ liệu được get từ db */
        static::retrieved(function (Category $category) {
            // gọi khi model được get từ database ra
        });

        /** Tạo mới (chưa lưu) */
        static::creating(function (Category $category) {
            // beforeCreate()
        });

        /** Khi tạo mới thành công (đã lưu) */
        static::created(function (Category $category) {
            // afterCreate()
            // $model->slug = Str::slug($category->name);
        });

        /** Update dữ liệu (chưa lưu) */
        static::updating(function (Category $category) {
            // beforeUpdate()
        });

        /** Update dữ liệu thành công (đã lưu) */
        static::updated(function (Category $category) {
            // afterUpdate()
        });

        /** Thực hiện trước khi xóa */
        static::deleting(function (Category $category) {
            // beforeDelete()
        });

        /** Thực hiện khi xóa thành công */
        static::deleted(function (Category $category) {
            // afterDelete()
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
        $query->where('created_at', '>', Carbon::now()->startOfDay()->subDays($numberDay));
    }
}
