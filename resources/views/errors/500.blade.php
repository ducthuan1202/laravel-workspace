@extends('backend.layouts.error')

@section('title') 500 @endsection

@section('content')
    <h2 class="text-center">405: {{ $exception->getMessage() }}</h2>
@endsection