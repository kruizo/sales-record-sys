@extends('layouts.auth')

@section('content')

<div class="card bg-gray-800">
    <div class="flex items-center p-4  dark:border-gray-600">
        <x-form-header text="Reset Password" />
    </div>


    <div class="p-4 md:p5" id="form-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ request('email') }}" required autocomplete="email" autofocus>



            <div class="py-2">
                <x-input-label for="password" text="New Password" />
                <x-input-text id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="py-2">
                <x-input-label for="password-confirm" text="Confirm Password" />

                <x-input-text id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="py-2">
                <x-button-primary type="submit" text="Reset Password" />

            </div>

        </form>
    </div>
</div>
@endsection