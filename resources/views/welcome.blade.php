@extends('layouts.app')

@section('title')
    <title>Adelfor</title>
@endsection

@section('import')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection
@section('content')
    <section id="home" class="relative">

        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 -z-10 to-transparent  top-0"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-gray-950 -z-10 to-transparent  bottom-0"></div>

        <div id="video-container" class="absolute bg-[rgba(0,0,0,0.5)] -z-20 h-full w-full overflow-hidden">
            <video id="background-video" class="" autoplay muted loop playsinline
                style="width: 100%; height: 100%; object-fit: cover;">
                <source src="{{ asset('assets/waterbg.mp4') }}" type="video/mp4">
            </video>
        </div>
        <section class="-z-20 h-full sm:py-32 flex justify-center items-center " id="hero">
            <div
                class="py-8 px-4 flex-col flex h-full gap-3 justify-center mx-auto lg: max-w-screen-xl text-center lg:pt-16 lg:px-12">
                <h1
                    class="mb-4 text-5xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl dark:text-white font-poppins">
                    We give
                    <span class="neon">
                        <h1>100%</h1>

                    </span>
                    pure quality.
                </h1>


                <p
                    class="mb-8 text-lg font-light font-poppins text-gray-400 lg:text-lg sm:px-16 xl:px-48 dark:text-gray-400">
                    Optimize your hydration with our premium water refilling service. Enjoy pure and refreshing water that
                    satisfies and revitalizes. Choose excellence in every drop..</p>
                <div class="flex mb-8 lg:mb-16 gap-2 justify-center sm:flex-row">
                    <a href="{{ route('order') }}"
                        class=" inline-flex justify-center gap-2 items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        Order now
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <a href="#"
                        class="inline-flex justify-center gap-2 bg-gray-100 items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        Call us
                    </a>
                </div>
                <div
                    class="space-y-4 sm:grid sm:grid-cols-2 lg:flex justify-around gap-y-4 items-center px-12 py-12 mt-8 lg:flex-wrap">
                    <div class="flex flex-col flex-wrap">
                        <h1 class="text-xl text-gray-500">Open</h1>
                        <div
                            class="flex flex-wrap align-top items-center justify-center gap-2 text-xl md:text-xl text-gray-400">
                            <i class="fa fa-clock-o " aria-hidden="true"></i>
                            <h2 class="font-raleway"><strong>12 hrs</strong></h2>
                        </div>
                    </div>
                    <div class="flex flex-col flex-wrap">
                        <h1 class="text-xl text-gray-500">Guaranteed</h1>
                        <div
                            class="flex flex-wrap align-top items-center justify-center gap-2 text-xl md:text-xl text-gray-400">
                            <i class='fas fa-shipping-fast' aria-hidden="true"></i>
                            <h2 class="font-raleway"><strong>Fast Delivery</strong></h2>
                        </div>

                    </div>
                    <div class="flex flex-col flex-wrap">
                        <h1 class="text-xl text-gray-500">Water</h1>
                        <div
                            class="flex flex-wrap align-top items-center justify-center gap-2 text-xl md:text-xl text-gray-400">
                            <i class='fas fa-medal'></i>
                            <h2 class="font-raleway"><strong>High Quality</strong></h2>
                        </div>
                    </div>

                    <div class="flex flex-col flex-wrap">
                        <h1 class="text-xl text-gray-500">Weekly Order</h1>
                        <div
                            class="flex flex-wrap align-top items-center justify-center gap-2 text-xl md:text-xl text-gray-400">
                            <i class="fas fa-shopping-cart"></i>
                            <h2 class="font-raleway"><strong>121 Orders</strong></h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <section class="flex flex-col items-center overflow-hidden" id="services">
        <h2 class="mb-4 text-4xl tracking-tight text-gray-200 font-poppins dark:text-white">
            What we do.</h2>
        <div data-aos="zoom-out" data-aos-once="true">
            <div
                class="gap-8  items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6 flex lg:flex-row flex-col-reverse">
                <div class="mt-4 md:mt-0">
                    <h2 class="mb-4 text-3xl tracking-tight text-gray-200 font-poppins dark:text-white">Bringing Convenience
                        to Your Doorstep.</h2>
                    <p class="mb-6 font-light text-gray-300 md:text-lg dark:text-gray-300">A dedicated delivery rider stands
                        proudly next to a sleek motorcycle loaded with pristine, blue water cooler bottles. With the sun
                        casting a warm glow, it portrays the convenience and speed of our water delivery service. Whether at
                        your home or office, we ensure quick and efficient hydration delivery with a smile.</p>
                </div>
                <div class="relative w-full image-zoom-container overflow-hidden rounded-2xl">
                    <div class="z-30 absolute inset-0 bg-black opacity-60 hover:opacity-30 transition-opacity"></div>
                    <img class="w-full h-72 object-cover dark:hidden image-zoom"
                        src="{{ asset('assets/image/service4.png') }}" alt="service-image-shop">
                </div>
            </div>
        </div>

        <div data-aos="zoom-out" data-aos-once="true">
            <div
                class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6 flex lg:flex-row-reverse flex-col">
                <div class="relative w-full image-zoom-container overflow-hidden rounded-2xl">
                    <div class="z-30 absolute inset-0 bg-black opacity-50 hover:opacity-30 transition-opacity"></div>
                    <img class="w-full h-72 object-cover dark:hidden image-zoom"
                        src="{{ asset('assets/image/service3.png') }}" alt="service-image-1">
                </div>

                <div class="mt-4 md:mt-0">
                    <h2 class="mb-4 text-3xl tracking-tight text-gray-200 font-poppins dark:text-white">Crafting Pure
                        Hydration: The Art of Gallon Refilling</h2>
                    <p class="mb-6 font-light text-gray-300 md:text-lg dark:text-gray-300">Precision meets purity as a
                        skilled hand carefully refills a water gallon at our station. The crystal-clear water flows
                        gracefully, filling the container to the brim. It's a snapshot of our commitment to delivering
                        pristine hydration, one gallon at a time. Trust us for the freshest, most refreshing water for your
                        home or office.</p>
                </div>
            </div>
        </div>
    </section>



    <section class="wave relative overflow-hidden pb-40" id="about">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-poppins text-gray-200 dark:text-white">Why choose us</h2>
                <p class="font-light text-gray-300 lg:mb-16 sm:text-xl dark:text-gray-400">We offer vast choices of high
                    quality services.</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                <div class="items-center bg-gray-900 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700"
                    data-aos="flip-right" data-aos-once="true">
                    <img class="w-3/5 h-full object-cover rounded-lg sm:rounded-none sm:rounded-l-lg"
                        src="{{ asset('assets/image/service1.png') }}" alt="Bonnie Avatar">
                    <div class="p-5 w-full text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-300 dark:text-white">
                            <a href="#">Delivery</a>
                        </h3>
                        <p class="mt-3 mb-4 font-light text-gray-400 dark:text-gray-400">Ensure fast delivery anytime.</p>
                    </div>
                </div>
                <div class="items-center bg-gray-900 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700"
                    data-aos="flip-right" data-aos-once="true">
                    <img class="w-3/5 h-full object-cover rounded-lg sm:rounded-none sm:rounded-l-lg"
                        src="{{ asset('assets/image/service3.png') }}" alt="Bonnie Avatar">
                    <div class="p-5 w-full text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-300 dark:text-white">
                            <a href="#">Refill</a>
                        </h3>
                        <p class="mt-3 mb-4 font-light text-gray-400 dark:text-gray-400">With high quality water.</p>
                    </div>
                </div>
                <div class="items-center bg-gray-900 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700"
                    data-aos="flip-right" data-aos-once="true">
                    <img class="w-3/5 h-full object-cover rounded-lg sm:rounded-none sm:rounded-l-lg"
                        src="{{ asset('assets/image/discount.jpeg') }}" alt="Bonnie Avatar">
                    <div class="p-5 w-full text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-300 dark:text-white">
                            <a href="#">Discounts</a>
                        </h3>
                        <p class="mt-3 mb-4 font-light text-gray-400 dark:text-gray-400">Applicable to confirmed purchases.
                        </p>
                    </div>
                </div>
                <div class="items-center bg-gray-900 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700"
                    data-aos="flip-right" data-aos-once="true">
                    <img class="w-3/5 h-full object-cover rounded-lg sm:rounded-none sm:rounded-l-lg"
                        src="{{ asset('assets/image/service4.png') }}" alt="Bonnie Avatar">
                    <div class="p-5 w-full text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-300 dark:text-white">
                            <a href="#">Wholesale</a>
                        </h3>
                        <p class="mt-3 mb-4 font-light text-gray-400 dark:text-gray-400">Massive discounts for everybody.
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <section class="bg-gray-50 pb-28">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2
                    class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 dark:text-white font-poppins">
                    Enjoy your quality water today</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">We give exciting discounts for our
                    beloved customers.</p>
                <a href="#"
                    class="text-white bg-blue-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Order
                    now</a>
            </div>
        </div>
    </section>

    <section class="py-8 bg-gray-50 lg:py-24 dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-8xl lg:px-4">
            <div class="xl:mx-64 2xl:mx-80">
                <h1
                    class="mb-4 tracking-tight font-bold leading-tight text-gray-900 lg:font-extrabold text-4xl lg:leading-none dark:text-white text-center lg:mb-7 font-poppins">
                    Contact us</h1>
                <p class="mb-10 text-lg font-normal text-gray-500 dark:text-gray-400 lg:text-center lg:text-xl">Reach us
                    for inquiries. We respond in not less than an hour😁</p>
            </div>
        </div>
        <div class="px-4 mx-auto max-w-8xl lg:px-4">
            <div class="p-4 mx-auto max-w-3xl rounded-lg border-gray-50 shadow-md dark:bg-gray-800 lg:p-8">
                <form>
                    <div class="grid md:gap-8 md:grid-cols-2">
                        <div class="mb-6">
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First name</label>
                            <input required="" type="text" id="first_name" placeholder="John"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="">
                        </div>
                        <div class="mb-6">
                            <label for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last name</label>
                            <input required="" type="text" id="last_name" placeholder="Doe"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                        <input required="" type="email" id="email" placeholder="john.doe@company.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="">
                    </div>
                    <div class="mb-6">
                        <label for="subject"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                        <input required="" type="text" id="subject"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Subject name" value="">
                    </div>
                    <div class="mb-6"><label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Message</label>
                        <textarea required="" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Your message..."></textarea>
                    </div>
                    <button
                        class="text-white font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center bg-blue-700"
                        type="submit"><span class="flex justify-center items-center">Send message</span></button>
                </form>
            </div>
        </div>
    </section>
    <script>
        AOS.init();
    </script>
@endsection
