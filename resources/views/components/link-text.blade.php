@props(['text' => 'Link', 'href' => '', 'tabindex' => ''])

<a href="{{ $href }}" tabindex="{{ $tabindex }}"
    {{ $attributes->merge(['class' => 'text-blue-700 hover:underline dark:text-blue-500']) }}>{{ $text }}</a>
