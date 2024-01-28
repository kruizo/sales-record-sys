@extends('layouts.app')

@section('title')
<title>Adelflor</title>
@endsection
@section('content')
<div class="z-10 dark:bg-gray-950 min-h-screen sm:p-28">
    <x-section-header text="Your orders" />
    <div class="block">
        <div class="flex w-full h-full space-x-3">
            <section id="item-list" class="w-4/6 space-y-3">
                <x-cart-item />
                <x-cart-item />
                <x-cart-item />
                <x-cart-item />
                <x-cart-item />

            </section>
            <div class="w-1/4 fixed right-24 bg-gray-900">
                <section id="item-list">
                    <div id="item" class="p-4 w-full">
                        <h1 class="text-xl">Order Information</h1>

                        <div class="grid grid-cols-2 space-y-1 py-5">
                            <h2>Reference Number:</h2>
                            <h2>A7328372837238272</h2>

                            <h2>Date ordered:</h2>
                            <h2>05/31/32</h2>

                            <h2>Delivery Date:</h2>
                            <h2>05/31/32</h2>

                            <h2>Delivery Address:</h2>
                            <h2>B9 Meadows Mintal</h2>

                            <h2>Delivery Status:</h2>
                            <h2>In progress</h2>

                            <h2>Mode of Payment:</h2>
                            <h2>Cash on Delivery</h2>

                        </div>
                        <x-button-primary text="Cancel Order" />
                    </div>
                </section>
            </div>


        </div>
    </div>

</div>
@endsection