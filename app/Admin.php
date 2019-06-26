<?php

namespace App;

use App\Entities\Category;
use App\Entities\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * @package App
 *
 * @property integer id
 * @property string name
 * @property string email
 * @property string password
 * @property string image
 * @property integer role
 * @property integer is_activate
 * @property string remember_token
 * @property string email_verified_at
 *
 * @property string created_at
 * @property string updated_at
 *
 * @property Category[] categories
 * @property Product[] products
 */
class Admin extends Authenticatable
{
    use Notifiable;

    const
        YES = 1,
        NO = 0;
    const
        ROLE_ADMIN = 1,
        ROLE_MEMBER = 2;

    protected $table = 'admins';
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role', 'is_activate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_activate' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | QUAN HỆ GIỮA CÁC MODEL
    |--------------------------------------------------------------------------
    */
    public function products(){
        return $this->hasMany(Product::class, 'created_by', 'id');
    }

    public function categories(){
        return $this->hasMany(Category::class, 'created_by', 'id');
    }
}
