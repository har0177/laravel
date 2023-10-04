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
			<h1 class="text-xl text-white font-semibold">Add Gallery</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->


				<div>
					<label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
					<input id="title" name="title" type="text" wire:model="title"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="Title of Images">
					@error('title')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>


				<div>

					@if ($image)
						<div class="flex flex-wrap">
							@foreach ($image as $img)
								<div class="w-1/3 p-2">
									<img class="rounded h-16 block" src="{{ $img->temporaryUrl() }}">
								</div>
							@endforeach
						</div>
					@endif

					<br>
					<input wire:model="image"
					       multiple accept="image/png, image/jpg, image/jpeg, image/gif"
					       type="file" id="image"
					       class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full">
					<div wire:loading wire:target="image">
						<span class="text-green-500"> Uploading ... </span>
					</div>
					@error('image.*')
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
			<h1 class="text-xl text-white font-semibold">Gallery Management</h1>
			<div>
				<x-button wire:click="add">
					Create Gallery
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
					Image
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Status
						</div>
					</th>
					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($gallery as $gal)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $gal->title}}</td>
						<td class="border px-4 py-2 items-center">
								<img src="{{$gal->getFirstMediaUrl( 'gallery' )}}" class="rounded h-16 mt-5 block" alt="...">
						</td>
						<td class="border px-4 py-2">
							<div class="flex items-center justify-between">
								<h4 class="text-lg font-bold">{{ $gal->status }}</h4>
								<div class="relative inline-block w-12 align-middle select-none transition duration-200 ease-in">
									<input
										type="checkbox"
										id="toggle-{{ $gal->id }}"
										name="status"
										{{ $gal->status === 'Show' ? 'checked' : '' }}
										value="{{ $gal->status }}"
										wire:click="updateStatus({{ $gal->id }})"
										class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
									>
									<label
										for="toggle-{{ $gal->id }}"
										class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
									></label>
								</div>
							</div>
						</td>
						<td class="border px-4 py-2">
							<x-danger-button wire:click="deleteGallery({{$gal->id}})" wire:loading.attr="disabled">
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
			{{ $gallery->links() }}
		</div>

	@endif

</div>