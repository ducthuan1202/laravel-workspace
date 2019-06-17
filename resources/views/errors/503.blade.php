@extends('backend.layouts.error')

@section('title') 503 @endsection

@section('content')
    <h2 class="text-center">503: {{ $exception->getMessage() }}</h2>
@endsection