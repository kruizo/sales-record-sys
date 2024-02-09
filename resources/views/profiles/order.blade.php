@extends('layouts.app')

@section('title')
<title>Adelflor</title>
@endsection
@section('content')
<div class="z-10 p-6 dark:bg-gray-950 min-h-screen sm:p-40">
        <x-section-header text="Your orders" />
        
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-blue-600 h-fit mb-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        {{ $status ??'In progress'}} 
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        </button>
        
        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{route('profile/myorders', ['filter&status=inprogress'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">In progress</a>
            </li>
             <li>
                <a href="{{route('profile/myorders', ['filter&status=completed'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</a>
            </li>
            <li>
                <a href="{{route('profile/myorders', ['filter&status=cancelled'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cancelled</a>
            </li>
           
    
            </ul>
        </div>
    <div class="flex w-full h-full space-x-3">
        <section id="item-list" class="w-full lg:w-full space-y-3 transition-all ease-in-out">

            @foreach ($orders  as $order)

            @foreach ($order->orderline as $orderline)
            <div class=" bg-gray-900 px-4 hover:cursor-pointer h-28 w-2/3 overflow-hidden transition-height hover:scale-105 duration-200 ease-in-out" id="item-{{$orderline->id}}" onclick="handleOrderLineClick({{$orderline->id}})">
                <div class="flex items-center h-full py-2">
                    <img src="{{ asset('assets/image/container1.png') }}" alt="" class="object-contain h-24 w-20 pt-3" draggable="false">
            
                    <div class="flex justify-between w-full">
                        <div class="flex flex-col justify-start h-full w-full md:w-1/4 ml-4">
                            <strong>
                                <h1 class="text-xl">{{$orderline->water->name}}</h1>
                            </strong>
                            <h1 class="text-md w-full">Qty. x{{$orderline->quantity}}</h1>
{{-- {{$orderline->delivery->deliverystatus->status}} --}}
                            <h1 class="text-blue-600 text-xl">{{$orderline->delivery->deliverystatus->status}}</h1>
                        </div>
                        <div class="justify-between hidden md:flex h-full space-x-4 w-1/2 ">
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Quantity</h1>
                                <h1 class="text-xl">{{$orderline->quantity}}</h1>
                            </div>
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Price</h1>
                                <h1 class="text-xl">₱{{$orderline->water->cost}}</h1>
                            </div>
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Total</h1>
                                <h1 class="text-xl">₱{{$orderline->subtotal}}</h1>
                            </div>
                        </div>
                
                    </div>
                </div>
                <div class="px-5" id="item-info-{{$orderline->id}}">
                    <h1 class="text-xl">Order Information</h1>
                <div class="grid grid-cols-2 space-y-1 py-5 w-full">
                    <h2 ">Order Number:</h2>
                    <h2 >{{ $orderline->id }}</h2>
        
                    <h2 >Date ordered:</h2>
                    <h2 >{{ $orderline->created_at->format('m/d/y') }}</h2>
        
                    <h2 >Delivery Date:</h2>
                    <h2 >{{ optional($orderline->delivery)->delivery_date->format('m/d/y') }}</h2>
        
                    <h2 >Delivery Address:</h2>
                    <h2 >{{ optional($orderline->delivery)->delivery_address }}</h2>
        
                    <h2 >Delivery Status:</h2>
                    <h2 >{{ optional($orderline->delivery)->delivery_status }}</h2>
        
                    <h2 >Mode of Payment:</h2>
                    <h2 >{{ $order->payment_type }}</h2>
                </div>
                <x-button-link text="Cancel Order" href="{{ route('cancel.order', ['id' => $orderline->id]) }}" class="text-red-600 p-0" />

                </div>

            </div>
            
            @endforeach
            
            @endforeach
           
        </section>
        
    </div>
</div>
<script src="{{ asset('assets/js/myorders.js') }}"></script>
@endsection