@extends('layouts.app')

@section('title')
<title>Order</title>
@endsection

@section('import')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>

@endsection
@section('content')
<div class="-z-20 dark:bg-gray-950 min-h-full sm:pt-28 sm:px-24">
    <div class="flex justify-between items-center">
        <x-section-header class="" text="Choose a product" />
    </div>
    <form method="POST" action="{{ route('place-order') }}" id="orderForm">
        @csrf

        @if($errors->any())
            <div id="toast-simple" class="animate-toast flex fixed top-40 left-0 right-0 mx-auto z-20 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-gray-900 border border-red-600 divide-x rtl:divide-x-reverse divide-red-600 rounded-lg shadow " role="alert">
                <svg class="flex-shrink-0 text-red-600 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                  </svg>
                <div class="ps-4 text-sm font-normal text-red-600">{{ $errors->first() }}</div>
            </div>
        @endif


        <div class="justify-between w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7" id="product-data" data-products='@json($waters)'>
            @foreach ($waters as $water)
            <x-product-card name="{{$water->id}}" id="{{$water->type}}" price="{{$water->cost}}" productName="{{$water->name}}" size="5gal." />
                
            @endforeach
        </div>
        <div class="justify-center w-full gap-4 mt-5 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2  w-full md:w-3/4 ">
                <x-form-header text="Your information" />
                <div class="flex gap-2 my-5">
                    <div class="w-full">
                        <x-input-label text="First Name" for="firstname" />
                        <x-input-text id="firstname" name="first_name" value="{{ $customer->firstname ?? '' }}" readonly />

                    </div>
                    <div class="w-full">
                        <x-input-label text="Last Name" for="lastname" />
                        <x-input-text id="lastname" name="last_name" value="{{$customer->lastname  ?? ''}}" readonly />
                    </div>
                  
                </div>
            

                <div class="w-full my-5">
                    <x-input-label text="Email" for="email" />
                    <x-input-text id="email" name="email" value="{{$customer->email ?? Auth::user()->email}}" readonly />
                </div>
                <div class="w-full my-5">
                    <x-input-label text="Contact Number" for="contactnumber" />
                    <x-input-text id="contactnumber" name="contact_number" value="{{$customer->contactnum ?? ''}}" readonly />
                </div>
                <div class="w-full my-5">
                    <x-input-label text="Street Address" for="streetaddress" />
                    <x-input-text id="streetaddress" name="street_address" value="{{$address->streetaddress ?? ''}}" readonly />
                </div>
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <x-input-label text="Province" for="province" />
                        <x-input-text id="province" name="province" value="{{$address->province ?? ''}}" readonly />
                    </div>

                    <div class="w-1/2">
                        <x-input-label text="Baranngay" for="barangay" />
                        <x-input-text id="barangay" name="barangay" value="{{$address->barangay ?? ''}}" readonly />
                    </div>

                </div>
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <x-input-label text="City" for="city" />
                        <x-input-text id="city" name="city" value="{{$address->city ?? ''}}" readonly />

                    </div>
                    <div class="w-1/2">
                        <x-input-label text="Postal/Zip" for="zip" />
                        <x-input-text type="number" id="zip" name="zip" value="{{$address->zip ?? ''}}" readonly />
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-center w-full gap-4 mt-5 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2 w-full md:w-3/4 ">
                <x-form-header text="Billing Information" />
             
                <div class="py-2 hidden" id="payment">
                    <p class="text-gray-100 text-md">Payment Method</p>
                    <div class="flex flex-col">
                        <x-radio-bordered id="codradio" name="payment_method" value="Cash on Delivery" :isChecked=true/>
                        <x-radio-bordered id="gcashradio" name="payment_method" value="Credit Card" />
                        <x-radio-bordered id="creditradio" name="payment_method" value="GCash" />
                    </div>

                </div>
                <div class="flex w-full">
                    <div id="textaddress" class="w-full">
                        <div class="w-full my-5">
                            <x-input-label text="Delivery Address" for="deliveryaddress" />
                            <x-input-text id="deliveryaddress" name="delivery_address" value="{{$address->full_address  ?? ''}}" />
                        </div>
                        
                    </div>

                </div>
                <div class="w-full" class="newiframe" id="newframe" style="display: none">
                    <iframe id="newmap" src="{{route('map.show')}}" class="w-full h-96" scrolling="no"></iframe>
                </div>
                <div class="w-full">
                    <button class="hover:bg-gray-700 rounded-lg text-lg text-blue-600 py-2 p-2" data-modal-target="mapmodal" data-modal-toggle="mapmodal" id="openModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i><span class="pl-2">Add map reference</span></button>
                </div>
                <div class="py-2" id="payment">
                    <p class="text-gray-100 text-md">Payment Method</p>
                    <div class="flex flex-col">
                        <x-radio-bordered id="codradio" name="payment_method" value="Cash on Delivery" />
                        <x-radio-bordered id="gcashradio" name="payment_method" value="Credit Card" />
                        <x-radio-bordered id="creditradio" name="payment_method" value="GCash" />
                    </div>

                </div>
                <input type="hidden" name="mapreference" id="mapreference">
                <div class="py-2">
                    <p class="text-gray-100 text-md">Expected Date and Time</p>
                    <div class="space-y-2">
                        <div class="relative w-1/3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" name="expected_date" class="border z-10 border-gray-700 bg-gray-800 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                        <input type="time" name="expected_time" class="border z-10 w-1/3 border-gray-700 bg-gray-800 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select time">
                    </div>
                </div>
                <div class="py-2">
                    <p class="text-gray-100 text-md">Special Instructions</p>
                    <textarea maxlength="300" id="specialinstruction" name="special_instructions" rows="4" cols="1" class="bg-gray-800 border-none w-full"></textarea>

                </div>
            </div>
        </div>
        <div class="justify-center w-full gap-4 mt-5 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2 w-full md:w-3/4 ">
                <input type="hidden" name="total_order" id="total-input" class="total-input">

                <x-form-header text="Order information" />

                <div id="order-information" class="space-y-2">
                    <h1>You have <span id="total-order">0 </span>order(s)</h1> 
                </div>
            </div>
        </div>
        <x-button-primary text="Submit" class="max-w-fit float-right h-10 my-5 bg-green-500 hover:bg-green-600"/>
    </form>
</div>

@include('modals/map')
<script src="{{ asset('assets/js/order.js') }}"></script>
@endsection

