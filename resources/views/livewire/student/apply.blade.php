<div class="bg-white border border-gray-300 rounded-lg shadow-lg">

	@if (session()->has('success'))
		<x-flash-success-message message="{{ session('success') }}"/>
	@endif
	@if (session()->has('error'))
		<x-flash-error-message message="{{ session('error') }}"/>
	@endif


	@if($applyPanel)
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between rounded-t-lg">
			<h1 class="text-xl text-white font-semibold">Apply for {{$diplomaName}}</h1>
			<div class="text-white">
				Application #: {{$application_number}} &nbsp; &nbsp; Status: {{$status}}
			</div>
		</div>
		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="storeApplication">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->

				<div class="mb-4">
					<label for="toggleQuota" class="block text-sm font-medium text-gray-700 mb-1">Select Quota to Apply</label>
					<div class="space-y-2">
						@foreach($quotaList as $list)
							<label class="relative flex items-center">
								<input type="checkbox"
								       id="{{ str_slug($list->name) }}"
								       name="quota[]"
								       value="{{$list->id}}"
								       wire:model="quota"
								       wire:click="checkQuota"
								       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
								<span class="ml-8">{{$list->name}}</span>
							</label>
						@endforeach
					</div>
					@error('quota')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-4">
					<label for="hostel" class="block text-sm font-medium text-gray-700 mb-1">Hostel Required</label>
					<div class="space-y-2">
						<label class="relative flex items-center">
							<input type="radio"
							       id="hostel"
							       name="hostel"
							       value="1"
							       wire:model="hostel"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">Yes</span>
						</label>
						<label class="relative flex items-center">
							<input type="radio"
							       id="hostel"
							       value="0"
							       name="hostel"
							       wire:model="hostel"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">No</span>
						</label>

					</div>
					@error('hostel')
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
							@if(!$project->applications)
								<x-button class="ml-3" wire:click="applyNow({{$project->id}})" wire:loading.attr="disabled">
									Apply Now
								</x-button>
							@else
								<a target="_blank" href="{{ route('print-form', ['application' => $project->applications[0]]) }}"
								   class="inline-block ml-2 px-3 text-white py-1 bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">View
									Form</a>
							@endif
						</div>
					</div>

					@if($project->applications && empty($project->applications[0]->challan_number))
						<p style="color: red" class="px-2">Please Submit the fee of Rs. {{$project->fee}}/- by downloading the challan form and then submit challan number
							here.</p>
						<div class="flex justify-between items-center bg-gray-100 p-3">

							<form wire:submit.prevent="saveChallan({{$project->applications[0]->id}})" class="flex items-center">
								<input wire:model="challan_number" nam="challan_number" type="text" placeholder="Enter Challan Number"
								       class="px-2 py-1 border rounded-md focus:outline-none focus:border-blue-500">

								<button type="submit"
								        class="ml-2 px-3 py-1 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 transition duration-300">
									Submit
								</button>

							</form>
							@error('challan_number')
							<span class="text-red-600 text-sm">{{ $message }}</span>
							@enderror
						</div>
					@else
						<div class="py-2 px-4 text-center text-white rounded-t-lg">
										<span
											class="px-2 py-1 text-sm font-semibold rounded-lg bg-green-500 text-white">Paid Challan #: {{$project->applications[0]->challan_number}}</span>

						</div>
					@endif
				</div>
			@empty
				<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300 p-6">
					<p class="text-center text-gray-500">No projects available to apply.</p>
				</div>
			@endforelse
		</div>
	@endif

</div>
