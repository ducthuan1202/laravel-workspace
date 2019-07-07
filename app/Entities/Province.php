<?php

namespace App\Entities;

/**
 * Class Province
 * @package App\Entities
 * ----------------------------------------------------
 * @property integer name
 * @property integer name_en
 * @property integer snappy_id
 *
 * @property District[] districts
 * @property Commune[] communes
 */
class Province extends BaseModel
{

    /** @var string $table */
    protected $table = 'provinces';

    /** @var array $fillable */
    protected $fillable = ['name', 'name_en', 'snappy_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class, 'province_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function communes()
    {
        return $this->hasMany(Commune::class, 'province_id', 'id');
    }
}
