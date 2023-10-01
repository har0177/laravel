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
			<h1 class="text-xl text-white font-semibold">{{$editContent ? 'Update Content' : 'Add Content'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
				<!-- Name field -->
				<div>
					<label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
					<input id="title" name="title" type="text" wire:model="title"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="John Doe">
					@error('title')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
				<!-- Last Name field -->
				<div>
					<label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
					<textarea id="title" name="father_name" wire:model="title"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					></textarea>
					@error('description')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>



			</div>
			<button type="submit"
			        wire:loading.attr="disabled"
			        class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
				<span wire:loading wire:target="updateProfile">Saving...</span>
				<span wire:loading.remove wire:target="updateProfile">Submit</span>
			</button>

		</form>



	@else


		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Content Management</h1>
			<div>
				<x-button wire:click="add">
					Create Content
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

			</div>
			<table class="table-auto w-full border mt-5">
				<thead class="bg-gray-200">
				<tr>
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							No
							<x-sorting name="id"/>
						</div>
					</th>
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							Title
							<x-sorting name="title"/>
						</div>
					</th>
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
				Description
						</div>
					</th>

					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($contents as $content)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $content->title }}</td>
						<td class="border px-4 py-2">{{ $content->description }}</td>

						<td class="border px-4 py-2">
							<div class="flex h-full items-center">

								<x-button class="ml-3" wire:click="edit({{$content->id}})" title="Edit Content Form"
								          wire:loading.attr="disabled">
									<i class="fas fa-edit"></i>
								</x-button>


								<div x-data="{ showModal: false }">


									<x-danger-button wire:click="changeStatus({{$content->id}})" class="ml-3" @click="showModal = true">
										<i class="fas fa-trash-alt"></i>
									</x-danger-button>

									<!-- Modal -->
									<div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
										<div class="bg-white rounded shadow-lg w-80">
											<div class="modal-header bg-indigo-600 text-white rounded-t">
												<div class="flex items-center justify-between p-3">
													<h5 class="text-lg font-semibold">Delete Content</h5>
													<button @click="showModal = false" class="text-white hover:text-gray-200">
														<span>&times;</span>
													</button>
												</div>
											</div>

											<div class="modal-body p-4">
												<p class="text-gray-700">Are you sure you want to delete this Content?</p>
											</div>

											<div class="modal-footer flex justify-end p-4 bg-gray-100 rounded-b">
												<button @click="showModal = false"
												        class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none">
													Close
												</button>
												<button wire:click.prevent="deleteContent()" @click="showModal = false"
												        class="ml-2 px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600 focus:outline-none">
													Yes, Proceed
												</button>
											</div>
										</div>
									</div>
								</div>
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
			{{ $contents->links() }}
		</div>

	@endif

</div>

@push('scripts')
	<script>
	 Livewire.directive('confirm', ({ el, directive, component, cleanup }) => {
		 let content = directive.expression

		 let onClick = e => {
			 if (!confirm(content)) {
				 e.preventDefault()
				 e.stopImmediatePropagation()
			 }
		 }
		 el.addEventListener('click', onClick, { capture: true })
		 cleanup(() => {
			 el.removeEventListener('click', onClick)
		 })
	 })
	</script>

@endpush