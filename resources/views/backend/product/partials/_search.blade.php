<?php
/**
 * @var array $params
 */
use Illuminate\Support\Arr;
?>
<div class="card mb-3">

    <div class="card-body">

        {{ Form::open(['url' => admin_route('products.index'), 'method' => 'GET', 'class'=>''])}}

        <div class="form-row">

            <div class="col">
                {{ Form::text('keyword', Arr::get($params, 'keyword'), ['class' => 'form-control']) }}
            </div>

            <div class="col">
                {{ Form::select('status', $model->listStatus(true), Arr::get($params, 'status'), ['class' => 'form-control']) }}
            </div>

            <div class="col">
                {{ Form::select('feature', $model->listFeature(true), Arr::get($params, 'feature'), ['class' => 'form-control']) }}
            </div>

            <div class="col">
                {{ Form::submit('Tìm kiếm', ['class' => 'btn btn-primary']) }}
            </div>

        </div>

        {{ Form::close() }}

    </div>

</div>

