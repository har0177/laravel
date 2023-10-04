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
			<h1 class="text-xl text-white font-semibold">Add Event</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->


				<div>
					<label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
					<input id="title" name="title" type="text" wire:model="title"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="e.g. Title of an Event">
					@error('title')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				<div>
					<label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
					<input id="expiry_date" name="expiry_date" type="datetime-local" wire:model="expiry_date"
					       wire:change="updateExpiryDate"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					>
					@error('expiry_date')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				<div>
					<label for="name" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
					<div class="relative">
						<select name="type" id="type" wire:model.live="type"
						        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option>Select Type</option>
							<option value="Text">Text</option>
							<option value="File">File</option>

						</select>

					</div>
					@error('type')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				@if($type === 'Text')
					<div>
						<label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
						<textarea id="description" name="description" type="text" wire:model="description"
						          class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
						</textarea>
						@error('description')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>
				@endif

				@if($type === 'File')
					<div>
						<input wire:model="file" type="file" id="file"
						       class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full">
						<div wire:loading wire:target="file">
							<span class="text-green-500"> Uploading ... </span>
						</div>
						@error('file')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>
				@endif


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
			<h1 class="text-xl text-white font-semibold">Events Management</h1>
			<div>
				<x-button wire:click="add">
					Create Events
				</x-button>
			</div>
		</div>


		<!-- Card Body -->
		<div class="mt-5 px-8">
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
							Title
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Type
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							File / Description
						</div>
					</th>
					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($events as $event)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $event->title }}</td>
						<td class="border px-4 py-2">{{ $event->type }}</td>
						<td class="border px-4 py-2 items-center">
							@if($event->type === 'File')
								@if (in_array(\Str::afterLast($event->getFirstMediaUrl( 'events' ), '.'), ['jpg', 'png', 'jpeg', 'gif']))
									<img src="{{$event->getFirstMediaUrl( 'events' )}}" class="rounded h-16 mt-5 block" alt="...">
								@else
									<a href="{{$event->getFirstMediaUrl( 'events' )}}" class="text-blue-500 hover:underline">Download</a>
								@endif
							@else
								{{ $event->description }}
							@endif
						</td>
						<td class="border px-4 py-2">
							<x-button class="ml-3" wire:click="edit({{$event->id}})" title="Edit Event Form"
							          wire:loading.attr="disabled">
								<i class="fas fa-edit"></i>
							</x-button>

							<x-danger-button wire:click="deleteEvent({{$event->id}})" wire:loading.attr="disabled">
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
		<!-- Card Footer -->
		<div class="py-4 px-8">
			{{ $events->links() }}
		</div>

	@endif

</div>