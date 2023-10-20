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
     body {

         font-family: Roboto, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji !important;

     }

     table thead .sorting:before, table thead .sorting_asc:before, table thead .sorting_desc:before {
         background-image: none !important;
     }

     table thead .sorting:after, table thead .sorting_asc:after, table thead .sorting_desc:after {
         background-image: none !important;
     }


     table td, table th {
         padding: 0.2rem 1rem;
         text-wrap: none;
         border: 1px solid #f3f2f7;
     }

     .border-b-8 {
         border-bottom-width: 8px
     }



     .ql-editor {
         height: 300px;
     }
	</style>
</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-100">
	<div class="flex">
		<div class="w-1/4 p-2 bg-gray-200"> <!-- Left Sidebar (Menu) -->

			@livewire('navigation-menu')
		</div>
		<div class="p-4" style="width: 80%"> <!-- Right Content -->
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
	</div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


@stack('scripts')

</body>
</html>