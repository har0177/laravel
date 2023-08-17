<div class="bg-white border border-gray-300 rounded-lg shadow-lg">


	<div class="mt-4 mb-4 mx-6 text-center">
		@if (session()->has('success'))
			<div class="py-2 bg-green-500 text-white rounded">{{ session('success') }}</div>
		@endif

		@if (session()->has('error'))
			<div class="py-2 bg-red-500 text-white rounded">{{ session('error') }}</div>
		@endif
	</div>

	@if($applyPanel)
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between rounded-t-lg">
			<h1 class="text-xl text-white font-semibold">Apply for {{$diplomaName}}</h1>
			<div class="text-white">
				Challan #: {{$challan_number}} &nbsp; &nbsp; Status: {{$status}}
			</div>
		</div>
		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="storeApplication">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->

				<div>
					<label for="quota" class="block text-sm font-medium text-gray-700 mb-1">Select Quota to Apply</label>
					<select name="quota[]" id="quota" wire:model.live="quota" multiple
					        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						<option>Select Quota</option>
						@foreach($quotaList as $list)
							<option value="{{$list->id}}">{{$list->name}}</option>
						@endforeach
					</select>
					@error('quota')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
			</div>
			<button type="submit"
			        wire:loading.attr="disabled"
			        class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
				<span wire:loading wire:target="storeApplication">Saving...</span>
				<span wire:loading.remove wire:target="storeApplication">Submit</span>
			</button>
			<x-button type="button" wire:click="toggleSection">
				Reset
			</x-button>

		</form>

	@else
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between rounded-t-lg">
			<h1 class="text-xl text-white font-semibold">Online Project Applications</h1>
		</div>
		<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 p-6">
			@forelse($projects as $project)
				<div
					class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300 hover:shadow-lg transition duration-300 ease-in-out">
					<div class="bg-gray-600 py-2 px-4 text-center text-white rounded-t-lg">
						<h6 class="text-sm font-semibold">{{ $project->diploma->name }}</h6>
					</div>
					<div class="p-4">
						<p class="text-sm text-gray-700 text-justify">{{ $project->description }}</p>
					</div>
					<div class="flex justify-between items-center bg-gray-100 p-3">
						<small class="text-red-600">{{ \Carbon\Carbon::parse($project->expiry_date)->format('d-M-Y') }}</small>
						<div>
							<x-button class="ml-3" wire:click="applyNow({{$project->id}})" wire:loading.attr="disabled">
								Apply Now
							</x-button>
							<a href="{{ route('apply') }}"
							   class="inline-block ml-2 px-3 text-white py-1 bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">View
								Form</a>
						</div>
					</div>
				</div>
			@empty
				<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300 p-6">
					<p class="text-center text-gray-500">No projects available to apply.</p>
				</div>
			@endforelse
		</div>
	@endif
</div>
