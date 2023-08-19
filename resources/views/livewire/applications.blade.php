<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<x-flash-success-message message="{{ session('success') }}"/>
	@endif
	@if (session()->has('error'))
		<x-flash-error-message message="{{ session('error') }}"/>
	@endif


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
					<td class="border px-4 py-2">{{ $application->index + 1  }}</td>
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
						@if($application->status !== 'Paid' && $application->challan_number)
							<x-button class="ml-3" wire:click="paymentStatus({{$application->id}})" wire:loading.attr="disabled">
								<i class="fa-solid fa-dollar-sign"></i></x-button>
						@endif
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

</div>



