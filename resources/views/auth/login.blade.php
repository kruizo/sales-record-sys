@extends('layouts.auth')
@section('title')
    <title>Login | Adelfor</title>
@endsection
@section('content')


<div class="card h-full bg-gray-800">
    <div class="p-4 md:p5">
        <x-form-header text="Login" class="mb-4"/>

        <x-error-container />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="py-2">
                <x-input-label for="email" text="Email Address" />

                <x-input-text id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus />

              
            </div>

            <div class="py-2">
                <x-input-label for="password" text="Password" />

                <x-input-text id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />

             
            </div>

            <div class="flex justify-between">
                <div class="flex gap-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <x-input-label for="remember" text="Remember Me" />
                </div>

                @if (Route::has('password.request'))
                <x-link-text text="Forgot your password?" tabindex="-1" href="{{ route('password.request') }}" />
                @endif

            </div>

            <div class="py-2">
                <x-button-primary type="submit" text="Login" class="w-full"/>
            </div>
            <div class="py-2 flex">
                <p>Dont have an account? <span><x-link-text href="{{route('register')}}" text="Create an account" /></span></p>
            </div>
        </form>
    </div>
</div>

@endsection