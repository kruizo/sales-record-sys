@extends('layouts.app')

@section('title')
<title>Order</title>
@endsection

@section('import')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection
@section('content')
<div class="-z-20 dark:bg-gray-950 min-h-full sm:pt-28 sm:px-28">
    <x-section-header text="Choose a product" />
    <div class="justify-between flex w-full gap-4 mt-8">
        <div class="bg-gray-800 flex w-fit p-4 rounded-lg ">
            <div class="p-2 flex flex-col relative shadow-2xl">
                <div class="relative">
                    <h1 class="absolute text-2xl right-0 flex">5 <span class="">gal.</span></h1>
                    <h1 class="absolute text-2xl font-bold">₱90</h1>
                    <h1 class="absolute bottom-0 left-0 right-0 text-center text-3xl font-bold font-sans">Alkaline</h1>

                    <img src="{{ asset('assets/image/container1.png') }}" alt="" srcset="" class="object-contain h-64 w-64 py-2">
                </div>

                <div class=" text-center mt-3">
                    <h1 class="text-xl">Qty.</h1>
                    <div class="flex justify-center items-center mt-3 gap-4">
                        <button type="button" class="bg-gray-900 p-4 rounded-lg"><i class="fa fa-minus" aria-hidden="true"></i></button>

                        <h1>1</h1>
                        <button type="button" class="bg-gray-900 p-4 rounded-lg"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
@include('modals.authentication')
@endsection