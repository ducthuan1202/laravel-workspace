<?php

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CreateByMeScope implements Scope
{
    protected $userCreatedId;

    public function __construct($id = 0)
    {
        # nếu user login, lấy giá trị id của user
        if(auth()->check()){
            $this->userCreatedId = auth()->id();
        }

        # nếu có giá trị truyền vào, ghi đè id của user
        if($id){
            $this->userCreatedId = (int)$id;
        }

    }

    public function apply(Builder $builder, Model $model)
    {
        if(!empty($this->userCreatedId)){
            $builder->where('created_by', $this->userCreatedId);
        }
    }
}
