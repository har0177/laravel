<!-- resources/views/components/tooltip.blade.php -->

@props(['text'])

<div class="relative inline-block group">
	{{ $slot }}
	@if ($text)
		<div class="tooltip-text bg-gray-800 text-white p-2 text-xs rounded-md absolute hidden group-hover:block -mt-8">
			{{ $text }}
		</div>
	@endif
</div>
