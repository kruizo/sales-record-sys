@extends('layouts.auth')

@section('content')

<div class="card">
    <div class="flex items-center p-4  dark:border-gray-600">
        <x-form-header text="Reset Password" />
    </div>

    <div class="p-4 md:p5" id="form-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="py-2">
                <x-input-label for="email" text="Email Address" />

                <x-input-text id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <x-button-primary type="submit" text="Send Password Reset Link" />
        </form>
    </div>
</div>
@endsection