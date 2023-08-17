<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	<div class="mt-4 mb-4 text-center">
		@if (session()->has('success'))
			<span class="px-3  py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
		@endif


		@if (session()->has('error'))
			<span class="px-3 mt-4 mb-4 text-center py-1 bg-red-600 text-white rounded">{{ session('error') }}</span>
		@endif
	</div>


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
						Quota Applied
					</div>
				</th>
				<th scope="col" class="px-6 py-3">
					<div class="flex items-center">
						Payment Status
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
					<td class="border px-4 py-2">
						<ul class="list-disc list-inside">

							@foreach ($application->quotaName as $quotaName)
								<li>{{ $quotaName }}</li>
							@endforeach
						</ul>
					</td>
					<td class="border px-4 py-2">{{ $application->status}}</td>

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



