<!-- resources/views/components/Badge.blade.php -->

@props(['text', 'color'])

<span class="inline-block px-2 py-1 text-xs font-semibold leading-none text-white bg-{{ $color }}-500 rounded-full">{{ $text }}</span>
