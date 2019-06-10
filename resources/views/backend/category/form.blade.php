<?php
/**
 * @var \App\Entities\Category $model
 * @var string $title
 */
?>

@extends('backend.layouts.main')

@section('title'){{ $title }}@endsection

@section('content')

    @if($model->exists)
        {{ Form::open(['method' => 'POST', 'url' => admin_route('categories.update', $model->id)]) }}
        @method('PATCH')
    @else
        {{ Form::open(['method' => 'POST', 'url' => admin_route('categories.store')]) }}
    @endif

        <div class="card">
            <div class="card-header">
                <h6>{{ $title }}</h6>
            </div>
            <div class="card-body">

                @include('backend.layouts.partials.alert')

                <div class="form-group" data-hint="name">
                    {{ Form::label('name', 'Tên Danh Mục') }}
                    {{ Form::text('name', old('name') ? old('name') : $model->name, ['class' => 'form-control '. ($errors->has('name') ? 'is-invalid' : '') ]) }}
                    @if ($errors->has('name'))<div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                </div>

            </div>

            <div class="card-footer text-center">
                <a href="{{admin_route('categories.index')}}" class="btn btn-dark"> Quay lại </a>
                {{ Form::submit('Thực hiện', ['class' => 'btn btn-info']) }}
            </div>
        </div>
    {{ Form::close() }}

@endsection