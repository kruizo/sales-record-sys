@props(['text' => ''])

<h3 {{ $attributes->merge(['class' => 'text-xl font-semibold text-gray-100 dark:text-white']) }}>
    {{$text}}
</h3>