@extends('layouts.auth')
@section('title')
    <title>Set up profile</title>
@endsection
@section('content')
<div class="items-center py-4 text-gray-400 px-4" id="profilesetting" role="tabpanel" aria-labelledby="profilesetting-tab">
    <x-form-header text="Set up your profile" class="text-5xl pb-8"/>
    <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-4">
        <div class="w-full">
            <x-input-label for="firstname" text="First Name" class="text-gray-300" />
            <x-input-text id="firstname" class="border-none hover:cursor-default" readonly />
        </div>

        <div class="w-full">
            <x-input-label for="lastname" text="Last  Name" class="text-gray-300" />
            <x-input-text id="lastname" class="border-none hover:cursor-default" readonly />
        </div>

    </div>

    <div class="mb-2 sm:mb-4">
        <x-input-label for="email" text="Email" class="text-gray-300" />
        <x-input-text id="email" class="border-none hover:cursor-default" value="{{Auth::user()->email}}" readonly />
    </div>
    <div class="mb-2 sm:mb-4">
        <x-input-label for="contactnumber" text="Contact Number" class="text-gray-300" />
        <x-input-text id="contactnumber" class="border-none hover:cursor-default" readonly />
    </div>
    <div class="mb-2 sm:mb-4">
        <x-input-label for="streetaddress" text="Street Address" class="text-gray-300" />
        <x-input-text id="streetaddress" class="border-none hover:cursor-default" readonly />
    </div>
    <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-4">
        <div class="w-full">
            <x-input-label for="province" text="Province" class="text-gray-300" />
            <x-input-text id="province" class="border-none hover:cursor-default" readonly />
        </div>

        <div class="w-full">
            <x-input-label for="barangay" text="Barangay" class="text-gray-300" />
            <x-input-text id="barangay" class="border-none hover:cursor-default" readonly />
        </div>

    </div>
    <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-4">
        <div class="w-full">
            <x-input-label for="city" text="City" class="text-gray-300" />
            <x-input-text id="city" class="border-none hover:cursor-default" readonly />
        </div>

        <div class="w-full">
            <x-input-label for="zip" text="Postal/Zip" class="text-gray-300" />
            <x-input-text id="zip" type="number" class="border-none hover:cursor-default" readonly />
        </div>

    </div>
    <div class="flex justify-end">
        <button type="submit" class="text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
    </div>

</div>
@endsection