@if(count($errors))
    <div class="alert alert-danger my-3">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($message = Session::get('success'))
    <div class="alert alert-success my-3">
        <div class="alert-title"><strong>Thông báo thành công!</strong></div>
        <p> {{ $message }} </p>
    </div>
@endif
