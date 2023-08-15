<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	<div class="mt-4 mb-4 text-center">
		@if (session()->has('success'))
			<span class="px-3  py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
		@endif


		@if (session()->has('error'))
			<span class="px-3 mt-4 mb-4 text-center py-1 bg-red-600 text-white rounded">{{ session('error') }}</span>
		@endif
	</div>

@if($create)

	<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Add Slide</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
					<div class="relative">
						<select name="type" id="type" wire:model.live="type"
						        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option>Select Type</option>
							<option value="image">Image</option>
							<option value="video">Video</option>
						</select>

					</div>
					@error('name')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>

				@if($type === 'video')
					<div>
						<label for="url" class="block text-sm font-medium text-gray-700 mb-1">Link</label>
						<input id="url" name="url" type="text" wire:model.live="url"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="https://www.youtube.com/embed/VIDEO_ID OR https://www.facebook.com/video/embed?video_id=VIDEO_ID">
						@error('url')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>
				@endif

				@if($type === 'image')
					<div>
						@if ($image)
							<img class="rounded h-16 mt-5 block" src="{{ $image->temporaryUrl() }}">
						@endif
						<br>
						<input wire:model="image" accept="image/png, image/jpg, image/jpeg, image/gif" type="file" id="image"
						       class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full">
						<div wire:loading wire:target="image">
							<span class="text-green-500"> Uploading ... </span>
						</div>
						@error('image')
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
			<h1 class="text-xl text-white font-semibold">Slides Management</h1>
			<div>
				<x-button wire:click="add">
					Create Slides
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
							Type
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Url / Image
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
				@forelse($slides as $slide)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $slide->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $slide->type }}</td>
						<td class="border px-4 py-2 items-center">
							@if($slide->type === 'image')
								<img src="{{$slide->getFirstMediaUrl( 'slides' )}}" class="rounded h-16 mt-5 block" alt="...">
							@else
								<iframe class="videoEmbedded" src="{{ $slide->url }}"  frameborder="2" allowfullscreen=""></iframe>

							@endif
						</td>
						<td class="border px-4 py-2">
							<div class="flex items-center justify-between">
								<h4 class="text-lg font-bold">{{ $slide->status}}</h4>
								<div class="relative inline-block w-12 align-middle select-none transition duration-200 ease-in">
									<input
										type="checkbox"
										id="{{ $slide->index + 1 }}"
										name="status"
										{{ $slide->status === 'Show' ? 'checked' : '' }}
										value="{{ $slide->status}}"
										wire:model="status"
										wire:click="updateStatus({{$slide->id}})"
										class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
									>
									<label
										for="{{ $slide->index + 1 }}"
										class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
									></label>
								</div>
							</div>
						</td>
						<td class="border px-4 py-2">
							<x-danger-button wire:click="deleteSlide({{$slide->id}})" wire:loading.attr="disabled">
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
			{{ $slides->links() }}
		</div>

	@endif

</div>