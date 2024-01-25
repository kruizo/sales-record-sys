<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-gray-900 flex flex-col rounded-lg shadow ">
            <img src="{{ asset('assets/image/logo.png')}}" alt="logo" class="w-16 absolute left-0 right-0 m-auto -top-10" srcset="">
            <button type="button" class="float-right text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
            <div class="border-b border-gray-900 w-full">
                <ul class="flex flex-wrap justify-around -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg  border-gray-900 hover:text-gray-600 hover:border-gray-500" id="signin-tab" data-tabs-target="#signin" type="button" role="tab" aria-controls="signin" aria-selected="true">Sign in</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg border-gray-900 hover:text-gray-600 hover:border-gray-500  id=" register-tab" data-tabs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
                    </li>
                </ul>
            </div>

            <div class="default-tab-content">
                <div class="hidden" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                    <div class="flex items-center justify-between p-4 md:p-5 ">
                        <h3 class="text-xl font-semibold text-gray-100 ">
                            Sign in to our platform
                        </h3>

                    </div>
                    <div class="md:p-5">
                        <form class="space-y-4" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div>
                                <x-input-label for="email" text="Your email"></x-input-label>
                                <x-input-text placeholder="name@company.com" class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus></x-input-text>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for="password" text="Your password"></x-input-label>
                                <x-input-text type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"></x-input-text>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 ">
                                    </div>
                                    <x-input-label for="remember" text="Remember me" class="ms-2 "></x-input-label>
                                </div>

                                @if (Route::has('password.request'))
                                <x-link-text tabindex="-1" text="Forgot password?" href="{{ route('password.request') }}"></x-link-text>
                                @endif
                            </div>
                            <x-button-primary text="{{ __('Login') }}" type="submit"></x-button-primary>

                            <!-- <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Not registered? <x-link-text text="Create an account"></x-link-text>
                                    </div> -->
                        </form>
                    </div>
                </div>
                <div class="hidden" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <div class="flex items-center justify-between p-4 md:p-5 ">
                        <x-form-header text="Join us" />


                    </div>
                    <div class="p-4 md:p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <x-input-label for="name" text="Your name" />
                                <x-input-text type="text" name="name" id="name" required />
                            </div>

                            <div>
                                <x-input-label for="email" text="Your email" />
                                <x-input-text id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="name@company.com" required autocomplete="email" />
                            </div>

                            <div>
                                <x-input-label for="password" text="Password" />
                                <x-input-text id="password" type="password" placeholder="" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></x-input-text>
                            </div>

                            <div>
                                <x-input-label for="password-confirm" text="Confirm Passsword" />
                                <x-input-text id="password-confirm" type="password" placeholder="" class="form-control" name="password_confirmation" required autocomplete="new-password"></x-input-text>
                            </div>
                            <div class="flex items-start mb-5">
                                <div class="flex items-center h-5">
                                    <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 " required>
                                </div>
                                <label for="terms" class="ms-2 text-sm font-medium text-gray-300 ">I agree with the <a href="#" class="text-blue-600 hover:underline ">terms and conditions</a></label>
                            </div>

                            <x-button-primary text="Register" type="submit"></x-button-primary>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>