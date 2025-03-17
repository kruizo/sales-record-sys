@extends('layouts.auth')

@section('title')
<title>Verify your email</title>
@endsection
@section('content')

<div class="card bg-gray-800">
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
        <a href="{{ route('profile.show') }}">
            <x-button-primary text="Go to profile" class="w-full" />
        </a>
        @else
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <div class="my-5">
            <form class="d-inline" method="POST" action="{{ route('verify.email') }}" id="resend-form">
                @csrf
                <button id="resend-btn" type="submit" class="p-0 m-0 align-baseline text-blue-600">Click here to request email verification again.</button>
            </form>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const resendBtn = document.getElementById('resend-btn');
        const resendForm = document.getElementById('resend-form');
        const resendCooldownInSeconds = 15; 
        const lastClickTimestamp = localStorage.getItem('lastResendClick');
        const currentTime = Math.floor(Date.now() / 1000); 

        function startCooldown(remainingTime) {
            resendBtn.disabled = true;
            const originalText = resendBtn.innerText;

            const interval = setInterval(() => {
                resendBtn.innerText = `You can resend in ${remainingTime}s`;
                remainingTime--;

                if (remainingTime < 0) {
                    clearInterval(interval);
                    resendBtn.innerText = originalText;
                    resendBtn.disabled = false;
                    localStorage.removeItem('lastResendClick');
                }
            }, 1000);
        }

        if (lastClickTimestamp) {
            const elapsedTime = currentTime - parseInt(lastClickTimestamp);
            if (elapsedTime < resendCooldownInSeconds) {
                startCooldown(resendCooldownInSeconds - elapsedTime);
            }
        }

        resendForm.addEventListener('submit', function(event) {
            const now = Math.floor(Date.now() / 1000);
            localStorage.setItem('lastResendClick', now);

            startCooldown(resendCooldownInSeconds);
        });
    });
</script>
@endsection