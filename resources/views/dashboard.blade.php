<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
				<div class="bg-white p-4 shadow-md rounded-md">
					<h3 class="text-lg font-semibold mb-2">Registered Users</h3>
					<p class="text-gray-600">{{$users}}</p>
				</div>

				<div class="bg-white p-4 shadow-md rounded-md">
					<h3 class="text-lg font-semibold mb-2">Total Active Projects</h3>
					<p class="text-gray-600">{{$projects}}</p>
				</div>

				<div class="bg-white p-4 shadow-md rounded-md">
					<h3 class="text-lg font-semibold mb-2">Total Active Applications</h3>
					<p class="text-gray-600">{{$applications}}</p>
				</div>



				<div class="bg-white p-4 shadow-md rounded-md">
					<h3 class="text-lg font-semibold mb-2">Total Students</h3>
					<p class="text-gray-600">{{$students}}</p>
				</div>


			</div>
		</div>
	</div>
</x-app-layout>