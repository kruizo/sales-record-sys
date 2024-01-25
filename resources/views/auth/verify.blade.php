@extends('layouts.auth')

@section('content')

<div class="card">
    <div class="flex flex-col gap-5 items-center p-4 justify-center dark:border-gray-600">
        <x-form-header text="Verify your email address" />
        <i class="fa fa-envelope" aria-hidden="true" style="font-size: 4rem;"></i>

    </div>
    <div class="p-4 md:p5" id="form-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <x-link-text text="click here to request another" type="submit" class="p-0 m-0 align-baseline" />
        </form>
    </div>
</div>

@endsection