@if(session()->has('errors') || session()->has('error') )
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <x-error.error-toast error="{{$error}}" />
            @endforeach
            @if (session()->has('error'))
                <x-error.error-toast error="{{$error}}" />
            @endif
        </ul>
    </div>
@endif