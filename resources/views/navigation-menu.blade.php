@php

	$user = auth()->user();

@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

	<div class="flex items-center justify-center" style="place-content: center; padding: 10px;">
		<a href="{{ auth()->user()->role_name === 'Admin' ? route('dashboard') : route('student-dashboard') }}">
			<img src="{{ asset('images/100-years.png') }}" alt="100-years" class="float-end" style="width: 120px;">
		</a>
	</div>


	<!-- Responsive Settings Options -->
	<div class="pt-4 pb-1 border-t border-gray-200">
		<div class="flex items-center px-4">

			<div class="shrink-0 mr-3">
				<img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->avatar }}"
				     alt="{{ Auth::user()->full_name }}"/>
			</div>


			<div>
				<div class="font-medium text-base text-gray-800">{{ Auth::user()->full_name }}</div>
				<div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
			</div>
		</div>

		<div class="border-b-8">

			<!-- Authentication -->
			<form method="POST" action="{{ route('logout') }}" x-data>
				@csrf

				<x-responsive-nav-link href="{{ route('logout') }}"
				                       @click.prevent="$root.submit();">
					{{ __('Log Out') }}
				</x-responsive-nav-link>
			</form>

		</div>

	</div>

	<div class="border-b-2">
		<x-responsive-nav-link href="{{ auth()->user()->role_name === 'Student' ? route('student-dashboard')  : route('dashboard') }}" :active="request()->routeIs('dashboard')">
			{{ __('Dashboard') }}
		</x-responsive-nav-link>
	</div>
	@if(auth()->user()->role_name === 'Student')
		<div class="border-b-2">
			<x-responsive-nav-link wire:navigate :active="request()->routeIs('profile')" href="{{ route('profile') }}">
				Profile
			</x-responsive-nav-link>
		</div>
		<div class="border-b-2">
			<x-responsive-nav-link wire:navigate :active="request()->routeIs('education')"
			                       href="{{ route('education') }}">Education
			</x-responsive-nav-link>
		</div>
		<div class="border-b-2">
			<x-responsive-nav-link wire:navigate :active="request()->routeIs('apply')" href="{{ route('apply') }}">
				Online Apply
			</x-responsive-nav-link>
		</div>
	@else

		@can('manage roles')

			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('roles')"
				                       href="{{ route('roles') }}"> Role
				</x-responsive-nav-link>
			</div>
		@endcan

		@can('manage users')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('users')"
				                       href="{{ route('users') }}">
					Administrative Users
				</x-responsive-nav-link>
			</div>
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('registeredUsers')"
				                       href="{{ route('registeredUsers') }}">
					Registered Users
				</x-responsive-nav-link>
			</div>

		@endcan
		@can('manage students')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('students')"
				                       href="{{ route('students') }}"> Students
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage employees')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('employees')"
				                       href="{{ route('employees') }}"> Employees
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage events')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('events')" href="{{ route('events') }}">
					Events
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage slides')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('slides')" href="{{ route('slides') }}">
					Slides
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage gallery')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('gallery')" href="{{ route('gallery') }}">
					Gallery
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage projects')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('projects')"
				                       href="{{ route('projects') }}">
					Projects
				</x-responsive-nav-link>
			</div>
		@endcan
		@can('manage applications')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('applications')"
				                       href="{{ route('applications') }}">
					Applications
				</x-responsive-nav-link>

			</div>
		@endcan
		@can('generate merit-list')
			<div class="border-b-2">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('merit-lists')"
				                       href="{{ route('merit-lists') }}">
					Merit List
				</x-responsive-nav-link>
			</div>
		@endcan

	@endif

</nav>


