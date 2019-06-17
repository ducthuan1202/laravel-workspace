@extends('backend.layouts.main')

@section('title') {{ $title }} @endsection

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <h3>Collect chunk</h3>
        @foreach($data->chunk(3) as $items)
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4">{{ $item }}</div>
                @endforeach
            </div>
        @endforeach

    </main>
@endsection



