@extends('backend.layouts.error')

@section('title') 404 @endsection

@section('content')
    <h2 class="text-center">404: {{ $exception->getMessage() }}</h2>
@endsection




