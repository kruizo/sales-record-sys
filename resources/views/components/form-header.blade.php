@props(['text' => ''])

<h3 {{ $attributes->merge(['class' => 'text-2xl font-semibold text-gray-300 dark:text-white']) }}>
    {{$text}}
</h3>