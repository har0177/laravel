<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
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
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="updateApplication">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->

				<span>
						<label class="relative flex items-center">
					<input type="checkbox"
					       id="open-merit"
					       name="quota[]"
					       value="33"
					       wire:model="quota"
					       wire:click="checkQuota"
					       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
					<span class="ml-8">Open Merit</span>
				</label>
	</span>

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

		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Applications Management</h1>
		</div>
<!-- Card Body -->
	<div class="mt-5 px-8">
		<div class="flex justify-between">
			<div class="p-4">
				<input type="search" wire:model.live.debounce.500ms="search" placeholder="Search"
				       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
			</div>
			<div class="mr-2 mt-8">
				<input type="checkbox" class="mr-2 leading-tight" wire:model.live="paid"/> Payment Paid Only ?
			</div>
		</div>
		<table class="table-auto w-full border mt-5">
			<thead class="bg-gray-200">
			<tr>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						No
						<x-sorting name="id"/>
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Challan #
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Application #
					</div>
				</th>

				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Full Name
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Applied For
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Hostel Required
						<x-sorting name="hostel"/>
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Quota Applied
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Payment Status
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Action
					</div>
				</th>
			</tr>
			</thead>
			<tbody>
			@forelse($applications as $application)
				<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
					<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
					<td class="border px-4 py-2">{{ $application->challan_number }}</td>
					<td class="border px-4 py-2">{{ $application->application_number }}</td>
					<td class="border px-4 py-2">{{ $application->user->full_name }}</td>
					<td class="border px-4 py-2">{{ $application->project->diploma->name}}</td>
					<td class="border px-4 py-2">{{ $application->hostel ? 'Yes' : 'No'}}</td>
					<td class="border px-4 py-2">
						<ul class="list-disc list-inside">

							@foreach ($application->quotaName as $quotaName)
								<li>{{ $quotaName }}</li>
							@endforeach
						</ul>
					</td>
					<td class="border px-4 py-2">{{ $application->status}}</td>
					<td class="border px-4 py-2">
						<div class="flex h-full items-center">
							<x-button class="ml-3" wire:click="edit({{ $application->id}})" wire:loading.attr="disabled">
								<i class="fas fa-pencil"></i>
							</x-button>
							<a target="_blank" href="{{ route('print-form', ['application' => $application]) }}"
							   class="inline-block ml-2 px-3 text-white py-1 bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">
								<i class="fas fa-eye"></i>
							</a>
							@if($application->status !== 'Paid' && $application->challan_number)
								<x-button class="ml-3" wire:click="paymentStatus({{$application->id}})" wire:loading.attr="disabled">
									<i class="fa-solid fa-dollar-sign"></i>
								</x-button>
							@endif
						</div>
					</td>

				</tr>
			@empty
				<tr>
					<td class="border px-4 py-2" colspan="7">No Record Found.</td>
				</tr>
			@endforelse
			</tbody>
		</table>

	</div>
	<!-- Card Footer -->
	<div class="py-4 px-8">
		{{ $applications->links() }}
	</div>
		@endif
</div>



