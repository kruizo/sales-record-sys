@extends('layouts.auth')

@section('title')
<title>Verify your email</title>
@endsection
@section('content')

<div class="card">
    <div class="flex flex-col gap-5 items-center p-4 justify-center dark:border-gray-600">
            
        @if (!Auth::user()->hasVerifiedEmail())

        <x-form-header text="Verify your email address" />
        @else

        <x-form-header text="Your email is already verified" />
        @endif

        <i class="fa fa-envelope" aria-hidden="true" style="font-size: 4rem;"></i>
    
    </div>
    <div class="p-4 md:p5" id="form-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
        @if (Auth::user()->hasVerifiedEmail())
        <a href="{{ route('profile') }}">
            <x-button-primary text="Go to profile" />
        </a>
        @else
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <x-link-text text="click here to request another" type="submit" class="p-0 m-0 align-baseline" />
        </form>
        @endif

    </div>
</div>

@endsection