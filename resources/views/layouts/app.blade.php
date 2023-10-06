<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


	@stack('styles')
	<style>
     .ql-editor {
         height: 300px;
     }
	</style>
</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-100">

	@livewire('navigation-menu')


	<!-- Page Heading -->
	@if (isset($header))
		<header class="bg-white shadow">
			<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
				{{ $header }}
			</div>
		</header>


@endif


<!-- Page Content -->
	<main>
		{{ $slot }}
	</main>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


@stack('scripts')

</body>
</html>