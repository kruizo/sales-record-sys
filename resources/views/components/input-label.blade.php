@props(['text' => ''])

<label {{ $attributes->merge(['class' => 'block mb-2 text-sm text-gray-400 font-medium text-gray-300 dark:text-white']) }}>{{ $text }}</label>