<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<x-flash-success-message message="{{ session('success') }}"/>
	@endif
	@if (session()->has('error'))
		<x-flash-error-message message="{{ session('error') }}"/>
	@endif

	@if($create)

	<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">{{$editProject ? 'Update Project' : 'Add Project'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->
				<div>
					<label for="diploma_id" class="block text-sm font-medium text-gray-700 mb-1">Select Diploma</label>
					<div class="relative">
						<select name="type" id="diploma_id" wire:model.live="diploma_id"
						        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option>Select Diploma</option>
							@foreach($diplomaList as $diploma)
								<option value="{{$diploma->id}}"
								        @selected($diploma->id === $diploma_id)>{{$diploma->name}}</option>
							@endforeach
						</select>

					</div>
					@error('diploma_id')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				<div>
					<label for="fee" class="block text-sm font-medium text-gray-700 mb-1">Fee</label>
					<input id="fee" name="fee" type="number" min="0" wire:model="fee"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="1000">
					@error('fee')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
				<div>
					<label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
					<input id="expiry_date" name="expiry_date" type="datetime-local" wire:model="expiry_date"
					       wire:change="updateExpiryDate"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="1000">
					@error('expiry_date')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				<div>
					<label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
					<textarea row="5" id="description" name="description" wire:model="description"
					          class="editor appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					></textarea>
					@error('description')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				<div class="mb-4">
					<label for="toggleQuota" class="block text-sm font-medium text-gray-700 mb-1">Select Quota</label>
					<div class="space-y-2">
						@foreach($quotaList as $list)
							<label class="relative flex items-center">
								<input type="checkbox"
								       id="{{ str_slug($list->name) }}"
								       name="quota[]"
								       value="{{$list->id}}"
								       wire:model="quota"
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
				<span wire:loading wire:target="store">Saving...</span>
				<span wire:loading.remove wire:target="store">Submit</span>
			</button>
			<x-button type="button" wire:click="toggleSection">
				Reset
			</x-button>

		</form>



	@else


		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Projects Management</h1>
			<div>
				<x-button wire:click="add">
					Create Project
				</x-button>
			</div>
		</div>


		<!-- Card Body -->
		<div class="mt-5 px-8">
			<div class="flex justify-between">
				<div class="p-4">
					<input type="search" wire:model.live.debounce.500ms="search" placeholder="Search"
					       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
				</div>
				<div class="mr-2 mt-8">
					<input type="checkbox" class="mr-2 leading-tight" wire:model.live="active"/> Active Only ?
				</div>
			</div>
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
				<thead class="bg-gray-200">
				<tr>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							No
							<x-sorting name="id"/>
						</div>
					</th>
					<th scope="col" class="px-16 py-3">
						<div class="flex items-center">
							Diploma
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Fee
						</div>
					</th>
					<th scope="col" class="px-10 py-3">
						<div class="flex items-center">
							Expiry Date
						</div>
					</th>
					<th scope="col" class="px-24 py-3">
						<div class="flex items-center">
							Quota
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Description
						</div>
					</th>
					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($projects as $project)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $project->diploma->name }}</td>
						<td class="border px-4 py-2">{{ $project->fee }}</td>
						<td class="border px-4 py-2">{{ \Carbon\Carbon::parse($project->expiry_date )->format('d-M-Y')}}</td>
						<td class="border px-4 py-2">
							<ul class="list-disc list-inside">

								@foreach ($project->quotaName as $quotaName)
									<li>{{ $quotaName }}</li>
								@endforeach
							</ul>
						</td>
						<td class="border px-4 py-2">{{ substr($project->description, 0, 200) }}...</td>
						<td class="border px-4 py-2">
							<x-button class="ml-3" wire:click="edit({{$project->id}})" wire:loading.attr="disabled">
								<i class="fas fa-edit"></i>
							</x-button>
							<x-danger-button wire:click="deleteProject({{$project->id}})" wire:loading.attr="disabled">
								<i class="fas fa-trash-alt"></i>
							</x-danger-button>
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
		</div>
		<!-- Card Footer -->
		<div class="py-4 px-8">
			{{ $projects->links() }}
		</div>

	@endif

</div>



