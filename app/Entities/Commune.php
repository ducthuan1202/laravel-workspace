<?php

namespace App\Entities;


/**
 * Class Commune
 * @package App\Entities
 * ----------------------------------------------------
 * @property integer province_id
 * @property integer district_id
 * @property string name
 * @property string name_en
 * @property integer snappy_id
 *
 * @property Province province
 * @property District district
 */
class Commune extends BaseModel
{
    /** @var string $table */
    protected $table = 'communes';

    /** @var array $fillable */
    protected $fillable = ['province_id', 'district_id', 'name', 'name_en', 'snappy_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
