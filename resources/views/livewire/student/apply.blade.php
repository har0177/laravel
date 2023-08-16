<div class="bg-white border border-gray-300 rounded-lg shadow-lg">
	<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between rounded-t-lg">
		<h1 class="text-xl text-white font-semibold">Online Project Applications</h1>
	</div>

	<div class="mt-4 mb-4 mx-6 text-center">
		@if (session()->has('success'))
			<div class="py-2 bg-green-500 text-white rounded">{{ session('success') }}</div>
		@endif

		@if (session()->has('error'))
			<div class="py-2 bg-red-500 text-white rounded">{{ session('error') }}</div>
		@endif
	</div>

	<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 p-6">
		@forelse($projects as $project)
			<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300 hover:shadow-lg transition duration-300 ease-in-out">
				<div class="bg-gray-600 py-2 px-4 text-center text-white rounded-t-lg">
					<h6 class="text-sm font-semibold">{{ $project->diploma->name }}</h6>
				</div>
				<div class="p-4">
					<p class="text-sm text-gray-700 text-justify">{{ $project->description }}</p>
				</div>
				<div class="flex justify-between items-center bg-gray-100 p-3">
					<small class="text-red-600">{{ \Carbon\Carbon::parse($project->expiry_date)->format('d-M-Y') }}</small>
					<div>
						<a href="{{ route('apply') }}" class="inline-block px-3 py-1 text-white bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">Apply Now</a>
						<a href="{{ route('apply') }}" class="inline-block ml-2 px-3 text-white py-1 bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">View Form</a>
					</div>
				</div>
			</div>
		@empty
			<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300 p-6">
				<p class="text-center text-gray-500">No projects available to apply.</p>
			</div>
		@endforelse
	</div>
</div>
