@extends('layouts.app')
@section('title')
<title>Adelflor | Profile</title>
@endsection
@section('content')
<div class="-z-20 dark:bg-gray-950 min-h-full sm:p-28">
    <x-section-header text="Your profile" />
    <div class="text-gray-400 w-full flex flex-col gap-5 md:flex-row ">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <ul class="sticky flex flex-col gap-2 p-4 text-sm border-r border-gray-400  100 top-12">
                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>
                <li role="presentation">
                    <button id="signin-tab" data-tab-name="public-profile" data-tabs-target="#profilesetting" type="button" role="tab" aria-controls="profilesetting" aria-selected="true" class="flex items-center px-3 py-2.5 font-bold rounded-full">
                        Personal Information
                    </button>
                </li>
                <li role="presentation">
                    <button id="register-tab" data-tab-name="account-setting" data-tabs-target="#accountsetting" type="button" role="tab" aria-controls="accountsetting" aria-selected="false" class="flex items-center  px-3 py-2.5 font-bold  rounded-full">
                        Account Setting
                    </button>
                </li>

            </ul>
        </aside>
        <div class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4 default-tab-content">
            <div class="w-full px-8 py-5 sm:max-w-xl sm:rounded-lg">
                <div class="items-center mt-8 sm:mt-14 text-gray-400 space-y-4" id="profilesetting" role="tabpanel" aria-labelledby="profilesetting-tab">
                    <x-error-container />
                    
                    @if(session('success'))
                    <!-- This code will be executed when there is a 'success' message in the session -->
                    <div class="text-green-300">
                        {{ session('success') }}
                    </div>
                @endif
                    <div class="w-full"></div>
                    <div class="w-full flex items-center">
                        <x-input-label for="name" text="Name" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="name" name="name" class="border-none hover:cursor-default" readonly value="{{$customer->firstname ?? ''}} {{$customer->lastname ?? ''}}" />
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="contact" text="Contact Number" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="contact" name="contact" class="border-none hover:cursor-default" readonly value="{{$customer->contactnum ?? ''}}" />
                        </div>
                    </div>
                  
                    <div class="w-full flex items-center">
                        <x-input-label for="emailaccount" text="Email" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="emailaccount" name="email" class="pr-24 border-none hover:cursor-default" readonly value="{{Auth::user()->email}}" />
                            @if (!Auth::user()->isVerified())
                            <x-input-label text="Not verified" class="absolute right-5 mt-1 text-blue-500" />
                            @else
                            <x-input-label text="Verified" class="absolute right-5 mt-1 text-green-500" />
                            @endif
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="streetaddress" text="Street address" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="streetaddress" name="street_address" class="border-none hover:cursor-default" readonly value="{{$customer->address->streetaddress ?? ''}}" />
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="province" text="Province" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="province" name="province" class="border-none hover:cursor-default" readonly value="{{$customer->address->province ?? ''}}" />
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="barangay" text="Barangay" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="barangay" name="barangay" class="border-none hover:cursor-default" readonly value="{{$customer->address->barangay ?? ''}}" />
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="city" text="City" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="city" name="city" class="border-none hover:cursor-default" readonly value="{{$customer->address->city ?? ''}}" />
                        </div>
                    </div>
                    <div class="w-full flex items-center">
                        <x-input-label for="zip" text="Postal / Zip" class="text-gray-300 w-1/3" />
                        <div class="w-full h-fit items-center flex relative">
                            <x-input-text id="zip" name="zip" class="border-none hover:cursor-default" readonly value="{{$customer->address->zip ?? ''}}" />
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" data-modal-target="edit-profile" data-modal-toggle="edit-profile" class="text-white bg-green-700  hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Edit</button>
                    </div>
                </div>
                <div class="items-center mt-8 sm:mt-14 text-gray-400 hidden" id="accountsetting" role="tabpanel" aria-labelledby="accountsetting-tab">
                    <div class=" w-full mb-2 space-y-7 sm:mb-6">
                        <form action="{{route('profile.verify')}}" method="POST">
                            @csrf
                            <x-error-container />
                            <div class="w-full flex items-center">
                                <x-input-label for="emailaccount" text="Email" class="text-gray-300 w-1/3" />
                                <div class="w-full h-fit items-center flex relative">
                                    <x-input-text id="emailaccount" name="email" class="pr-24 border-none hover:cursor-default" readonly value="{{Auth::user()->email}}" />
                                    @if (!Auth::user()->isVerified())
                                    <x-button-primary type="submit" text="Verify" class="w-24 bg-transparent absolute right-0 hover:bg-transparent text-blue-500" />
                                    @else
                                    <x-input-label text="Verified" class="absolute right-5 mt-1 text-green-500" />
                                    @endif
                                </div>
                            </div>
                            
                        </form>
                        <div class="w-full my-5 flex justify-end ">
                            <a href="{{ route('password.request') }}">
                                <x-button-primary text="Change Password" class="w-52 text-white" />

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setInitialUIState();
        addTabClickListeners();
    });

    function setInitialUIState() {
        var urlParams = new URLSearchParams(window.location.hash.substring(1));
        var initialTabName = urlParams.get('tab');
        setActiveTab(initialTabName);
    }

    function addTabClickListeners() {
        var tabButtons = document.querySelectorAll('[data-tab-name]');
        tabButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var tabName = this.getAttribute('data-tab-name');
                updateURLParameters(tabName);
                setActiveTab(tabName);
            });
        });
    }

    function updateURLParameters(tabName) {
        var urlParams = new URLSearchParams(window.location.hash.substring(1));
        urlParams.set('tab', tabName);
        window.location.hash = urlParams.toString();
    }


    function setActiveTab(tabName) {
        var tabButtons = document.querySelectorAll('[data-tab-name]');
        console.log('Setting active tab:', tabName);
        tabButtons.forEach(function(button) {
            var isSelected = button.getAttribute('data-tab-name') === tabName;
            button.setAttribute('aria-selected', isSelected);
        });
    }
</script>
@include('modals.edit-profile')

@endsection
