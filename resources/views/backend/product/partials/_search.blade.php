<?php
/**
 * @var array $params
 */
use Illuminate\Support\Arr;
?>
<div class="card mb-3">

    <div class="card-body">

        {{ Form::open(['url' => admin_route('products.index'), 'method' => 'GET'])}}

        <div class="form-row">

            <div class="form-group col-md-6">
                {{ Form::text('keyword', Arr::get($params, 'keyword'), ['class' => 'form-control']) }}
            </div>

            <div class="form-group col-md-6">
                {{ Form::submit('Tìm kiếm', ['class' => 'btn btn-primary']) }}
            </div>

        </div>

        {{ Form::close() }}

    </div>

</div>

