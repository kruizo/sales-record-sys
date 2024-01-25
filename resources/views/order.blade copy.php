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
        <x-button-primary text="Next" type="button" class="max-w-fit h-10 hidden" id="nextButton" onclick="next()" />
        <x-button-primary text="< Previous" type="button" class="max-w-fit h-10 hidden " id="previousbutton" onclick="prev()" />

    </div>
    <form action="POST" action="{{route('/')}}">
        @csrf
        <div class="justify-between w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7" id="product-form">
            <x-product-card name="alkaline" id="alkaline" price="40" productName="Alkaline" size="5gal." />
            <x-product-card name="mineral" id="mineral" price="30" productName="Mineral" size="5gal." />
            <x-product-card name="distilled" id="distilled" price="20" productName="Distilled" size="5gal." />
        </div>
        <div class="flex justify-between w-full gap-4 mt-8 md:hidden md:space-y-0 space-y-7" id="user-form">
            <x-input-label text="First Name" for="firstname" />
            <x-input-text id="firstname" name="firstname" />
            <x-button-primary text="Submit" type="button" class="max-w-fit h-10 bg-green-400 hover:bg-green-600" id="submitButton" onclick="submit()" />

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

        nextButton.classList.toggle('hidden', !isAnyCardToggled);


        if (hiddenDiv.classList.contains('hidden')) {
            document.getElementById(productId).value = 0;
        } else {
            document.getElementById(productId).value = 1;
        }

        updateURLParameters();
    }

    function updateURLParameters() {
        var toggledCards = Array.from(document.querySelectorAll('.card:not(.hidden)')).map(card => card.id.replace('-card', ''));
        var urlParams = new URLSearchParams(window.location.hash.substring(1));
        var productForm = document.getElementById('product-form');

        cardIds.forEach(function(cardId) {
            var hiddenDiv = document.getElementById(cardId + '-hidden');
            var input = document.getElementById(cardId);
            var productForm = document.getElementById('product-form');
            if (hiddenDiv.classList.contains('hidden')) {
                urlParams.delete(cardId);
            } else {
                urlParams.set(cardId, input.value);
            }
            if (productForm.classList.contains('hidden')) {
                urlParams.set(cardId, input.value, 'form');
            }
        });
        if (!productForm.classList.contains('hidden')) {
            console.log('form not visible')
            urlParams.delete('form');

        } else {
            console.log('form visible')
            urlParams.set('form', 'visible');
        }

        var newURL = window.location.origin + window.location.pathname + '#' + Array.from(urlParams.entries()).map(pair => pair.join('=')).join('&');
        window.history.replaceState({}, document.title, newURL);
    }


    function setInitialUIState() {
        var urlParams = new URLSearchParams(window.location.hash.substring(1));
        if ()
            cardIds.forEach(function(cardId) {
                var input = document.getElementById(cardId);
                if (urlParams.has(cardId)) {
                    var card = document.getElementById(cardId + '-card');
                    document.getElementById(cardId + '-hidden').classList.remove('hidden');
                    document.getElementById('nextButton').classList.toggle('hidden');
                    card.classList.add('shadow-blue-700');
                    card.classList.add('shadow-2xl');
                    input.value = urlParams.get(cardId);
                }
            });
    }

    function next() {
        var productForm = document.getElementById('product-form');
        var userForm = document.getElementById('user-form');
        var nextButton = document.getElementById('nextButton');
        var previousButton = document.getElementById('previousbutton');
        nextButton.classList.toggle('hidden');
        previousButton.classList.toggle('hidden');
        productForm.classList.add('md:hidden');
        productForm.classList.add('hidden');
        userForm.classList.remove('md:hidden');
        updateURLParameters();
    }

    function submit() {
        console.log('submitted');
    }

    function incrementInput(productId) {
        var inputElement = document.getElementById(productId);
        inputElement.value = parseInt(inputElement.value) + 1;

        updateURLParameters();
    }

    function decrementInput(productId) {
        var inputElement = document.getElementById(productId);
        var currentValue = parseInt(inputElement.value);
        if (currentValue > 0) {
            inputElement.value = currentValue - 1;
        }

        updateURLParameters();
    }
</script>
@endsection

@section('modal')
@include('modals.authentication')
@endsection