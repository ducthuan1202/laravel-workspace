@extends('backend.layouts.error')
@section('title') 405 @endsection
@section('content')
    <h2 class="text-center">405: {{ $exception->getMessage() }}</h2>
@endsection




