<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
	<!-- Primary Navigation Menu -->
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between h-16">
			<div class="flex">

				<!-- Logo -->
				<div class="shrink-0 flex items-center">
					<a href="{{ auth()->user()->role_name === 'Admin' ? route('dashboard') : route('student-dashboard') }}">
						<img src="{{asset('images/100-years.png')}}" alt="100-years" class="float-end">
					</a>
				</div>
				<!-- Navigation Links -->
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">


					<x-nav-link wire:navigate
					            href="{{ auth()->user()->role_name === 'Admin' ? route('dashboard') : route('student-dashboard') }}"
					            :active="request()->routeIs('dashboard')">
						{{ __('Dashboard') }}
					</x-nav-link>


					@if(auth()->user()->role_name === 'Student')
						<x-nav-link wire:navigate :active="request()->routeIs('profile')" href="{{ route('profile') }}">
							Profile
						</x-nav-link>
						<x-nav-link wire:navigate :active="request()->routeIs('education')"
						            href="{{ route('education') }}">Education
						</x-nav-link>

						<x-nav-link wire:navigate :active="request()->routeIs('apply')" href="{{ route('apply') }}">
							Online Apply
						</x-nav-link>

					@else

						<x-dropdown>
							<x-slot name="trigger">
								<div class="mt-4">
									<button type="button"
									        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
										Roles & Users

										<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
										     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round"
											      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
										</svg>
									</button>
								</div>


							</x-slot>

							<x-slot name="content">

								@can('manage roles')
									<x-dropdown-link wire:navigate :active="request()->routeIs('roles')"
									                 href="{{ route('roles') }}"> Roles
									</x-dropdown-link>
								@endcan
								@can('manage users')
									<x-dropdown-link wire:navigate :active="request()->routeIs('users')" href="{{ route('users') }}">
										Administrative Users
									</x-dropdown-link>
									<x-dropdown-link wire:navigate :active="request()->routeIs('registeredUsers')"
									                 href="{{ route('registeredUsers') }}"> Registered Users
									</x-dropdown-link>
								@endcan


							</x-slot>
						</x-dropdown>
						@can('manage students')
							<x-nav-link wire:navigate :active="request()->routeIs('students')"
							            href="{{ route('students') }}"> Students
							</x-nav-link>
						@endcan
						<x-dropdown>
							<x-slot name="trigger">
								<div class="mt-4">
									<button type="button"
									        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
										Projects

										<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
										     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round"
											      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
										</svg>
									</button>
								</div>


							</x-slot>

							<x-slot name="content">

								@can('manage projects')
									<x-dropdown-link wire:navigate :active="request()->routeIs('projects')"
									                 href="{{ route('projects') }}">
										Projects
									</x-dropdown-link>
								@endcan
								@can('manage applications')
									<x-dropdown-link wire:navigate :active="request()->routeIs('applications')"
									                 href="{{ route('applications') }}">
										Applications
									</x-dropdown-link>
								@endcan
								@can('generate merit-list')
									<x-dropdown-link wire:navigate :active="request()->routeIs('merit-lists')"
									                 href="{{ route('merit-lists') }}">
										Merit List
									</x-dropdown-link>
								@endcan

							</x-slot>
						</x-dropdown>
						@can('manage taxonomies')
							<x-dropdown>
								<x-slot name="trigger">
									<div class="mt-4">
										<button type="button"
										        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
											Taxonomies
											<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
											     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
												      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
											</svg>
										</button>
									</div>


								</x-slot>

								<x-slot name="content">

									@php
										$taxonomies = \App\Models\Taxonomy::select('type')->distinct()->get();

									@endphp

									@foreach($taxonomies as $tax)
										<x-dropdown-link wire:navigate :active="request()->routeIs('taxonomies')"
										                 href="{{ route('taxonomies', ['type' => $tax->type]) }}">

											{{ucwords($tax->type)}}
										</x-dropdown-link>
									@endforeach


								</x-slot>
							</x-dropdown>
						@endcan
						<x-dropdown>
							<x-slot name="trigger">
								<div class="mt-4">
									<button type="button"
									        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
										Front Pages

										<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
										     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round"
											      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
										</svg>
									</button>
								</div>


							</x-slot>

							<x-slot name="content">

								@can('manage events')
									<x-dropdown-link wire:navigate :active="request()->routeIs('events')" href="{{ route('events') }}">
										Events
									</x-dropdown-link>
								@endcan
								@can('manage slides')
									<x-dropdown-link wire:navigate :active="request()->routeIs('slides')" href="{{ route('slides') }}">
										Slides
									</x-dropdown-link>
								@endcan
								@can('manage gallery')
									<x-dropdown-link wire:navigate :active="request()->routeIs('gallery')" href="{{ route('gallery') }}">
										Gallery
									</x-dropdown-link>
								@endcan


							</x-slot>
						</x-dropdown>

					@endif
				</div>
			</div>

			<div class="hidden sm:flex sm:items-center sm:ml-6">

				<!-- Settings Dropdown -->
				<div class="ml-3 relative">
					<x-dropdown align="right" width="48">
						<x-slot name="trigger">

							<div class="flex items-center px-4">

								<div class="shrink-0 mr-3">
									<img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->avatar }}"
									     alt="{{ Auth::user()->full_name }}"/>
								</div>

								<div>
									<button type="button"
									        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
										{{ Auth::user()->full_name }} ({{ Auth::user()->role->name }})

										<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
										     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round"
											      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
										</svg>
									</button>
								</div>
							</div>

						</x-slot>

						<x-slot name="content">
							<!-- Account Management -->
							<div class="block px-4 py-2 text-xs text-gray-400">
								{{ __('Manage Account') }}
							</div>

							<div class="border-t border-gray-200"></div>

							<!-- Authentication -->
							<form method="POST" action="{{ route('logout') }}" x-data>
								@csrf

								<x-dropdown-link href="{{ route('logout') }}"
								                 @click.prevent="$root.submit();">
									{{ __('Log Out') }}
								</x-dropdown-link>
							</form>
						</x-slot>
					</x-dropdown>
				</div>
			</div>

			<!-- Hamburger -->
			<div class="-mr-2 flex items-center sm:hidden">
				<button @click="open = ! open"
				        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
						      stroke-linecap="round"
						      stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
						<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
						      stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>
		</div>
	</div>


	<!-- Responsive Navigation Menu -->
	<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
		<div class="pt-2 pb-3 space-y-1">
			<x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
				{{ __('Dashboard') }}
			</x-responsive-nav-link>
		</div>
		@if(auth()->user()->role_name === 'Student')
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('profile')" href="{{ route('profile') }}">
					Profile
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('education')"
				                       href="{{ route('education') }}">Education
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('apply')" href="{{ route('apply') }}">
					Online Apply
				</x-responsive-nav-link>
			</div>
		@else

			@can('manage roles')

				<div class="pt-2 pb-3 space-y-1">
					<x-responsive-nav-link wire:navigate :active="request()->routeIs('roles')"
					                       href="{{ route('roles') }}"> Role
					</x-responsive-nav-link>
				</div>
			@endcan
			@can('manage users')
				<div class="pt-2 pb-3 space-y-1">
					<x-responsive-nav-link wire:navigate :active="request()->routeIs('users')" href="{{ route('users') }}">
						Users
					</x-responsive-nav-link>
				</div>
			@endcan
			@can('manage students')
				<div class="pt-2 pb-3 space-y-1">
					<x-responsive-nav-link wire:navigate :active="request()->routeIs('students')"
					                       href="{{ route('students') }}"> Students
					</x-responsive-nav-link>
				</div>
			@endcan
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('events')" href="{{ route('events') }}">
					Events
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('slides')" href="{{ route('slides') }}">
					Slides
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('gallery')" href="{{ route('gallery') }}">
					Gallery
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('projects')"
				                       href="{{ route('projects') }}">
					Projects
				</x-responsive-nav-link>
			</div>
			<div class="pt-2 pb-3 space-y-1">
				<x-responsive-nav-link wire:navigate :active="request()->routeIs('applications')"
				                       href="{{ route('applications') }}">
					Applications
				</x-responsive-nav-link>
			</div>
	@endif

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

			<div class="mt-3 space-y-1">

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
	</div>
</nav>


