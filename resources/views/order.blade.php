@extends('layouts.app')

@section('title')
<title>Order</title>
@endsection

@section('import')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection
@section('content')
<div class="-z-20 dark:bg-gray-950 min-h-full sm:pt-28 sm:px-24">
    <div class="flex justify-between items-center">
        <x-section-header text="Choose a product" />
    </div>
    <form action="POST" action="{{route('/')}}">
        @csrf
        <div class="justify-between w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7" id="product-form">
            <x-product-card name="alkaline" id="alkaline" price="40" productName="Alkaline" size="5gal." />
            <x-product-card name="mineral" id="mineral" price="30" productName="Mineral" size="5gal." />
            <x-product-card name="distilled" id="distilled" price="20" productName="Distilled" size="5gal." />
        </div>
        <div class="justify-center w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2  w-full md:w-3/4 ">
                <x-form-header text="Your information" />
                <div class="flex gap-2 my-5">
                    <div class="w-full">
                        <x-input-label text="First Name" for="firstname" />
                        <x-input-text id="firstname" name="firstname" readonly />

                    </div>

                    <div class="w-1/2">
                        <x-input-label text="Last Name" for="lastname" />
                        <x-input-text id="lastname" name="lastname" readonly />
                    </div>
                    <div>
                        <x-input-label text="Middle Initial" for="middleinitial" />
                        <x-input-text id="middleinitial" name="middleinitial" readonly />
                    </div>
                </div>

                <div class="flex gap-2">
                    <div class="w-full">
                        <x-input-label text="Email" for="email" />
                        <x-input-text id="email" name="email" readonly />


                    </div>



                </div>
                <div>
                    <x-input-label text="Contact Number" for="contact" />
                    <x-input-text id="contact" name="contact" readonly />
                </div>
            </div>
        </div>
        <div class="justify-center w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2 w-full md:w-3/4 ">
                <x-form-header text="Billing information" />
                <div class="w-full my-5">
                    <x-input-label text="Street Address" for="email" />
                    <x-input-text id="email" name="email" readonly />

                </div>
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <x-input-label text="State" for="firstname" />
                        <x-input-text id="firstname" name="firstname" readonly />

                    </div>

                    <div class="w-1/2">
                        <x-input-label text="Province" for="lastname" />
                        <x-input-text id="lastname" name="lastname" readonly />
                    </div>

                </div>
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <x-input-label text="City" for="firstname" />
                        <x-input-text id="firstname" name="firstname" readonly />

                    </div>

                    <div class="w-1/2">
                        <x-input-label text="Postal/Zip" for="lastname" />
                        <x-input-text id="lastname" name="lastname" readonly />
                    </div>

                </div>
                <x-button-primary text="Submit" type="button" class="max-w-fit float-right h-10 bg-green-400 hover:bg-green-600" id="submitButton" onclick="submit()" />



            </div>
        </div>
    </form>

</div>
<script>
    var cardIds = ['alkaline', 'mineral', 'distilled'];

    document.addEventListener('DOMContentLoaded', function() {
        setInitialUIState();
    });





    function toggleCard(productId) {
        var hiddenDiv = document.getElementById(productId + '-hidden');
        var inputValue = document.getElementById(productId).value;
        var card = document.getElementById(productId + '-card');
        var nextButton = document.getElementById('nextButton');

        hiddenDiv.classList.toggle('hidden');
        card.classList.toggle('shadow-blue-700', !hiddenDiv.classList.contains('hidden'));
        card.classList.toggle('shadow-2xl', !hiddenDiv.classList.contains('hidden'));
        var cards = document.querySelectorAll('.card');

        var isAnyCardToggled = Array.from(cards).some(card => !card.querySelector('.hidden'));


        if (hiddenDiv.classList.contains('hidden')) {
            document.getElementById(productId).value = 0;
        } else {
            document.getElementById(productId).value = 1;
        }

    }



    function submit() {
        console.log('submitted');
    }

    function incrementInput(productId) {
        var inputElement = document.getElementById(productId);
        inputElement.value = parseInt(inputElement.value) + 1;

    }

    function decrementInput(productId) {
        var inputElement = document.getElementById(productId);
        var currentValue = parseInt(inputElement.value);
        if (currentValue > 0) {
            inputElement.value = currentValue - 1;
        }

    }
</script>
@endsection

@section('modal')
@include('modals.authentication')
@endsection