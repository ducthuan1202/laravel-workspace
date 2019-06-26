<?php
/**
 * @var array $params
 * @var \App\Entities\Log $model
 */
use Illuminate\Support\Arr;

?>
<div class="card mb-3">

    <div class="card-body">

        {{ Form::open(['url' => admin_route('logs.index'), 'method' => 'GET', 'class'=>'', 'name'=>'searchForm'])}}
            @foreach ($model->listAction(true)->chunk(4) as $actions)
                <div class="row">
                    @foreach ($actions as $key => $action)
                        <div class="col-md-3 text-center">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="action" value="{{ $key }}"
                                           {{ (int)Arr::get($params, 'action') === $key ? 'checked' : '' }}
                                           onchange="document.searchForm.submit()">
                                    {{ $action }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach


            <div class="row">
                <div class="col-6">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control drp" placeholder="Chọn ngày" name="date" value="{{ Arr::get($params, 'date') }}"/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Chọn ngày</button>
                        </div>
                    </div>
                </div>
            </div>

        {{ Form::close() }}

    </div>

</div>

