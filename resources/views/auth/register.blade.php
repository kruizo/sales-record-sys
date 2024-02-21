@extends('layouts.auth')
@section('title')
    <title>Register | Adelflor</title>
@endsection
@section('content')

<div class="card bg-gray-800">
    <div class="p-4 md:p5" id="form-body">
        <x-form-header text="Register" class="mb-4"/>
        
        <x-error-container />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="py-2">
                <x-input-label for="email" text="Email Address" />
                <x-input-text id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" />
            </div>

            <div class="py-2">
                <x-input-label for="password" text="Password" />
                <x-input-text id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" />
            </div>

            <div class="py-2">
                <x-input-label for="password-confirm" text="Confirm Password" />
                <x-input-text id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" />
            </div>
            <div class="py-2">
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                    </div>
                    <label for="terms" class="ms-2 text-sm font-medium text-gray-300 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500" tabindex="-1">terms and conditions</a></label>
                </div>
            </div>
            <div class="py-2">
                <x-button-primary type="submit" text="Register" class="w-full"/>
            </div>
            <div class="py-2 flex">
                <p>Already have an account? <span><x-link-text href="{{route('login')}}" text="Sign in" /></span></p>
            </div>
        </form>
    </div>
</div>
@endsection