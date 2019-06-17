@extends('backend.layouts.error')

@section('title') 403 @endsection

@section('content')
    <h2 class="text-center">403: {{ $exception->getMessage() }}</h2>
@endsection




