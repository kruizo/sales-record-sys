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
                <div class="flex justify-between w-full">
                    <x-form-header text="Billing information" />
                    <div class="flex items-center justify-center gap-2">
                        <button class="hidden" onclick="setActive(this.id, 'openModal');" id="viewaddress" type="button"><i class="fa fa-edit" style="font-size:24px" arial-hidden="true"></i></button>
                        <button class="bg-gray-700 rounded-lg text-lg text-blue-600 py-1 p-2" data-modal-target="mapmodal" data-modal-toggle="mapmodal" id="openModal" type="button"><i style="font-size: 25px;" class="fa fa-map-marker"></i></button>
                    </div>
                </div>
                <div id="textaddress">

                    <div class="w-full my-5">
                        <x-input-label text="Street Address" for="street" />
                        <x-input-text id="street" name="street" readonly />

                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <x-input-label text="State" for="state" />
                            <x-input-text id="state" name="state" readonly />

                        </div>

                        <div class="w-1/2">
                            <x-input-label text="Province" for="province" />
                            <x-input-text id="province" name="province" readonly />
                        </div>

                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <x-input-label text="City" for="city" />
                            <x-input-text id="city" name="city" readonly />

                        </div>

                        <div class="w-1/2">
                            <x-input-label text="Postal/Zip" for="postal" />
                            <x-input-text type="number" id="postal" name="postal" readonly />
                        </div>

                    </div>


                </div>
                <div class="w-full" id="mapaddress">
                    <div class="newiframe" id="newframe" class="h-96" style="display: none">
                        <iframe id="newmap" src="{{route('map.show')}}" class="w-full h-96" scrolling="no"></iframe>
                    </div>
                </div>
                <div class="py-2">
                    <p class="text-gray-100 text-md">Are you walk-in or delivery?</p>
                    <div class="flex flex-col">
                        <x-radio-bordered id="walkin" name="deliveryMethod" value="Walk-in" />
                        <x-radio-bordered id="delivery" name="deliveryMethod" value="Delivery" />
                    </div>
                </div>
                <div class="py-2 hidden" id="payment">
                    <p class="text-gray-100 text-md">Payment Method</p>
                    <div class="flex flex-col">

                        <x-radio-bordered id="codradio" name="paymentMethod" value="Cash on Delivery" />
                        <x-radio-bordered id="gcashradio" name="paymentMethod" value="Credit Card" />
                        <x-radio-bordered id="creditradio" name="paymentMethod" value="GCash" />

                    </div>

                </div>
                <div class="py-2">
                    <p class="text-gray-100 text-md">Expected Date and Time</p>
                    <div class="space-y-2">
                        <div class="relative w-1/3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" class="border z-10 border-gray-700 bg-gray-800 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                        <input type="time" class="border z-10 w-1/3 border-gray-700 bg-gray-800 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select time">
                    </div>
                </div>
                <div class="py-2">
                    <p class="text-gray-100 text-md">Special Instructions</p>
                    <textarea maxlength="300" id="message" name="message" rows="4" cols="1" class="bg-gray-800 border-none w-full"></textarea>

                </div>
            </div>
        </div>
        <div class="justify-center w-full gap-4 mt-8 md:flex md:space-y-0 space-y-7 bg-gray-900 p-2" id="user-form">
            <div class="shadow-2xl p-2 w-full md:w-3/4 ">
                <x-form-header text="Order information" />

                <div id="order-information" class="space-y-2">
                    <h1>You have <span id="total-order">0 </span>order(s)</h1>

                </div>

            </div>
        </div>
        <x-button-primary text="Submit" type="button" class="max-w-fit float-right h-10 bg-green-400 hover:bg-green-600" id="submitButton" onclick="submit()" />
    </form>

</div>
@include('modals/map')
<script>
    let currentMarker = false;
    let latitude = 0;
    let longitude = 0;
    let activebtn = '';
    let order = {
        products: {
            alkaline: {
                name: 'Alkaline',
                price: 40,
                quantity: 0
            },
            mineral: {
                name: 'Mineral',
                price: 30,
                quantity: 0
            },
            distilled: {
                name: 'Distilled',
                price: 20,
                quantity: 0
            }
        },
        deliveryFee: 50,
        orderCount: 0
    };


    const deliveryMethodRadios = document.querySelectorAll('input[name="deliveryMethod"]');
    deliveryMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            updateOrder();
            console.log(radio.id);
            if (radio.id == 'delivery') {
                document.getElementById('payment').classList.remove('hidden');
            } else {
                document.getElementById('payment').classList.add('hidden');
            }

        });
    });



    function updateOrder() {
        const orderInformation = document.getElementById('order-information');
        orderInformation.innerHTML = '';

        const totalOrder = document.createElement('h1');
        totalOrder.id = 'total-order';
        totalOrder.innerText = `You have ${order.orderCount} order(s)`;
        orderInformation.appendChild(totalOrder);

        for (const productId in order.products) {
            const product = order.products[productId];

            if (product.quantity > 0) {
                const productName = document.createElement('h1');
                productName.id = 'product-name';
                productName.innerText = `${product.quantity} ${product.name}`;

                const productSubtotal = document.createElement('h2');
                productSubtotal.id = 'product-subtotal';
                productSubtotal.innerText = `₱${product.price * product.quantity}`;

                const productContainer = document.createElement('div');
                productContainer.classList.add('flex', 'justify-between');
                productContainer.appendChild(productName);
                productContainer.appendChild(productSubtotal);

                orderInformation.appendChild(productContainer);
            }
        }

        const deliveryRadio = document.getElementById('delivery');
        if (deliveryRadio.checked && order.deliveryFee > 0) {
            const deliveryText = document.createElement('h1');
            deliveryText.id = 'delivery-text';
            deliveryText.innerText = 'Delivery Fee';

            const deliveryTotal = document.createElement('h2');
            deliveryTotal.id = 'delivery-total';
            deliveryTotal.innerText = `₱${order.deliveryFee}`;

            const deliveryContainer = document.createElement('div');
            deliveryContainer.classList.add('flex', 'justify-between');
            deliveryContainer.appendChild(deliveryText);
            deliveryContainer.appendChild(deliveryTotal);

            orderInformation.appendChild(deliveryContainer);
        }

        if (order.orderCount > 0 || (deliveryRadio.checked && order.deliveryFee > 0)) {
            const totalText = document.createElement('h1');
            totalText.id = 'total-text';
            const deliveryRadio = document.getElementById('total-text')
            totalText.innerText = 'Total';

            const totalAmount = calculateTotal();

            const total = document.createElement('h2');
            total.id = 'total';
            total.innerText = `₱${totalAmount}`;

            const totalContainer = document.createElement('div');
            totalContainer.classList.add('flex', 'justify-between');
            totalContainer.appendChild(totalText);
            totalContainer.appendChild(total);

            orderInformation.appendChild(totalContainer);
        }
    }


    function calculateTotal() {
        let total = 0;
        for (const productId in order.products) {
            const product = order.products[productId];
            total += product.price * product.quantity;
        }
        if (document.getElementById('delivery').checked) {
            total += order.deliveryFee;
        }
        return total;
    }

    function updateSubtotal(id) {
        try {
            const quantityInput = document.getElementById(id);
            order.products[id].quantity = parseInt(quantityInput.value, 10);

            order.orderCount = Object.values(order.products).reduce((acc, product) => acc + product.quantity, 0);

            updateOrder();
        } catch (error) {
            console.error(error);
        }
    }



    window.addEventListener('message', handleLocationMessage);

    function showAddress() {
        document.getElementById('newframe').style.display = 'none';
        document.getElementById('textaddress').style.display = 'block';
        document.getElementById('viewaddress').style.display = 'none';
        document.getElementById('viewaddress').style.style = 'bg-transparent';
    }

    function showMap() {
        if (currentMarker) {
            var newIframe = document.getElementById('newmap');
            var mapframe = document.getElementById('newframe');
            const lat = latitude;
            const lng = longitude;
            resetmarker('newmap');

            newIframe.contentWindow.postMessage({
                lat,
                lng,
                action: 'view'
            }, '*');
            setActive('openModal', 'viewaddress');
            hideAddress();
        } else {
            alert('Please place a marker on the map before confirming.');
        }
    }


    function handleLocationMessage(event) {
        if (event.data && typeof event.data === 'object' && event.data.lat && event.data.lng) {
            const lat = event.data.lat;
            const lng = event.data.lng;
            latitude = lat;
            longitude = lng;
            currentMarker = true;
            document.getElementById('locationtxt').textContent = "Lat: " + latitude + " Lgn: " + longitude;
        }
    }

    function hideAddress() {
        document.getElementById('newframe').style.display = 'block';
        document.getElementById('textaddress').style.display = "none";
        document.getElementById('viewaddress').style.display = "flex";
    }


    function resetmarker(frame) {
        document.getElementById(frame).contentWindow.postMessage({
            action: 'resetMarker'
        }, '*');
        if (getActive() == 'openModal') {
            setActive('viewaddress', 'openModal');
        } else {
            document.getElementById('viewaddress').classList.toggle('hidden');
        }
    }

    function setActive(active, inactive) {
        if (active == 'viewaddress') {
            showAddress();
        } else {
            document.getElementById(active).style.backgroundColor = "rgb(0, 145, 255)";
            document.getElementById(active).style.color = "white";
        }

        activebtn = active;
    }

    function getActive() {
        return activebtn;
    }


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

        updateSubtotal(productId);

    }



    function submit() {
        console.log('submitted');
    }

    function incrementInput(productId) {
        var inputElement = document.getElementById(productId);
        inputElement.value = parseInt(inputElement.value) + 1;

        updateSubtotal(productId);

    }

    function decrementInput(productId) {
        var inputElement = document.getElementById(productId);
        var currentValue = parseInt(inputElement.value);
        if (currentValue == 1) {
            console.log('executed')
            toggleCard(productId);

        }
        if (currentValue > 0) {
            inputElement.value = currentValue - 1;
        }
        updateSubtotal(productId);

    }
</script>
@endsection

@section('modal')
@include('modals.authentication')
@endsection