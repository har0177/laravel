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

         max-width: 100%; /* Set a maximum width for the entire page */
         overflow-x: hidden; /* Hide horizontal scrollbar if content overflows */
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

     @media (max-width: 640px) {
         .hidden-sm {
             display: none;
         }
     }


	</style>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-100">
	@livewire('navigation-menu')

	<div class="flex">
		<div class="w-1/4 p-4 bg-gray-800 text-white hidden sm:block">
			<!-- Left Sidebar (Menu) -->
			<div class="mb-4 text-center uppercase text-xl">
				Main Menu
			</div>
			<ul class="text-lg space-y-2">
				<li class="border-b border-white">
						<x-responsive-nav-link style="white-space: nowrap;"
						href="{{ auth()->user()->role_name === 'Student' ? route('student-dashboard') : route('dashboard') }}"
						:active="request()->routeIs('dashboard')">
						{{ __('Dashboard') }}
					</x-responsive-nav-link>
				</li>
				@if(auth()->user()->role_name === 'Student')
					<li class="border-b border-white">

							<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('profile')"
						                       href="{{ route('profile') }}">
							Profile
						</x-responsive-nav-link>
					</li>
					<li class="border-b border-white">

							<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('education')"
						                       href="{{ route('education') }}">Education
						</x-responsive-nav-link>
					</li>
					<li class="border-b border-white">

							<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('apply')"
						                       href="{{ route('apply') }}">
							Online Apply
						</x-responsive-nav-link>
					</li>
				@else
					@can('manage roles')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('roles')"
							                       href="{{ route('roles') }}"> Role
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage users')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('users')"
							                       href="{{ route('users') }}">
								Administrative Users
							</x-responsive-nav-link>
						</li>
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('registeredUsers')"
							                       href="{{ route('registeredUsers') }}">
								Registered Users
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage students')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('students')"
							                       href="{{ route('students') }}"> Students
							</x-responsive-nav-link>
						</li>
                            <li class="border-b border-white">

                                <x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('send-sms')"
                                                       href="{{ route('send-sms') }}"> SMS Module
                                </x-responsive-nav-link>
                            </li>
					@endcan

					@can('manage employees')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('employees')"
							                       href="{{ route('employees') }}"> Employees
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage events')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('events')"
							                       href="{{ route('events') }}">
								Events
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage slides')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('slides')"
							                       href="{{ route('slides') }}">
								Slides
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage gallery')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('gallery')"
							                       href="{{ route('gallery') }}">
								Gallery
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage projects')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('projects')"
							                       href="{{ route('projects') }}">
								Projects
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('manage applications')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('applications')"
							                       href="{{ route('applications') }}">
								Applications
							</x-responsive-nav-link>
						</li>
					@endcan

					@can('generate merit-list')
						<li class="border-b border-white">

								<x-responsive-nav-link style="white-space: nowrap;" wire:navigate :active="request()->routeIs('merit-lists')"
							                       href="{{ route('merit-lists') }}">
								Merit List
							</x-responsive-nav-link>
						</li>
					@endcan
				@endif
			</ul>
		</div>
		<div class="p-4 w-full sm:w-3/4">
			<!-- Right Content -->
			{{ $slot }}
		</div>
	</div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


@stack('scripts')

</body>
</html>
