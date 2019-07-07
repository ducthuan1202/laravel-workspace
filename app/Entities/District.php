<?php

namespace App\Entities;

/**
 * Class District
 * @package App\Entities
 * ----------------------------------------------------
 * @property integer province_id
 * @property string name
 * @property string name_en
 * @property integer snappy_id
 *
 * @property Province province
 */
class District extends BaseModel
{
    /** @var string $table */
    protected $table = 'districts';

    /** @var array $fillable */
    protected $fillable = ['province_id', 'name', 'name_en', 'snappy_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function communes(){
        return $this->hasMany(Commune::class, 'district_id', 'id');
    }
}
