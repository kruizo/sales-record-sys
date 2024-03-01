@props(['text' => ''])
<h1
    {{ $attributes->merge(['class' => 'mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl text-gray-300 font-poppins']) }}>
    {{ $text }} </h1>
